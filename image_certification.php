<?php
/**
 * Image Certification System for Dragon Stone
 * Ensures all images are validated, certified, and securely handled
 */

class ImageCertificationSystem {
    
    private $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    private $maxFileSize = 5242880; // 5MB
    private $imageBasePath = 'assets/images/';
    private $certifiedImagesFile = 'certified_images.json';
    
    /**
     * Validate image file
     */
    public function validateImage($imagePath) {
        $validation = [
            'valid' => false,
            'errors' => [],
            'metadata' => []
        ];
        
        // Check if file exists
        if (!file_exists($imagePath)) {
            $validation['errors'][] = 'Image file does not exist';
            return $validation;
        }
        
        // Check file size
        $fileSize = filesize($imagePath);
        if ($fileSize > $this->maxFileSize) {
            $validation['errors'][] = 'Image file size exceeds maximum allowed (5MB)';
        }
        
        // Get file extension
        $extension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        if (!in_array($extension, $this->allowedExtensions)) {
            $validation['errors'][] = 'Invalid image format. Allowed: ' . implode(', ', $this->allowedExtensions);
        }
        
        // Validate image using getimagesize
        $imageInfo = @getimagesize($imagePath);
        if ($imageInfo === false) {
            $validation['errors'][] = 'Invalid or corrupted image file';
            return $validation;
        }
        
        // Extract metadata
        $validation['metadata'] = [
            'width' => $imageInfo[0],
            'height' => $imageInfo[1],
            'type' => $imageInfo[2],
            'mime_type' => $imageInfo['mime'],
            'file_size' => $fileSize,
            'extension' => $extension,
            'aspect_ratio' => round($imageInfo[0] / $imageInfo[1], 2)
        ];
        
        // Check minimum dimensions (optional)
        if ($imageInfo[0] < 100 || $imageInfo[1] < 100) {
            $validation['errors'][] = 'Image dimensions too small (minimum 100x100px)';
        }
        
        // Check for potential security issues
        $suspiciousTypes = [IMAGETYPE_WBMP, IMAGETYPE_XBM];
        if (in_array($imageInfo[2], $suspiciousTypes)) {
            $validation['errors'][] = 'Image type not allowed for security reasons';
        }
        
        // If no errors, mark as valid
        if (empty($validation['errors'])) {
            $validation['valid'] = true;
        }
        
        return $validation;
    }
    
    /**
     * Certify an image
     */
    public function certifyImage($imagePath, $productName = null) {
        $validation = $this->validateImage($imagePath);
        
        if (!$validation['valid']) {
            return [
                'certified' => false,
                'errors' => $validation['errors']
            ];
        }
        
        $certification = [
            'certified' => true,
            'certification_id' => $this->generateCertificationId(),
            'image_path' => $imagePath,
            'product_name' => $productName,
            'metadata' => $validation['metadata'],
            'certified_at' => date('Y-m-d H:i:s'),
            'file_hash' => hash_file('sha256', $imagePath),
            'security_scan' => $this->performSecurityScan($imagePath)
        ];
        
        // Save certification record
        $this->saveCertificationRecord($certification);
        
        return $certification;
    }
    
    /**
     * Generate unique certification ID
     */
    private function generateCertificationId() {
        return 'CERT-' . strtoupper(uniqid()) . '-' . date('Ymd');
    }
    
    /**
     * Perform basic security scan on image
     */
    private function performSecurityScan($imagePath) {
        $scan = [
            'clean' => true,
            'warnings' => []
        ];
        
        // Check for embedded scripts (basic check)
        $content = file_get_contents($imagePath);
        $suspiciousPatterns = [
            '/<script[^>]*>/i',
            '/javascript:/i',
            '/onload=/i',
            '/onerror=/i',
            '/<\?php/i'
        ];
        
        foreach ($suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                $scan['clean'] = false;
                $scan['warnings'][] = 'Suspicious content detected: ' . $pattern;
            }
        }
        
        // Check EXIF data for potential issues (if available)
        if (function_exists('exif_read_data')) {
            $exif = @exif_read_data($imagePath);
            if ($exif && isset($exif['Software'])) {
                $software = strtolower($exif['Software']);
                if (strpos($software, 'script') !== false || strpos($software, 'hack') !== false) {
                    $scan['warnings'][] = 'Suspicious software tag in EXIF data';
                }
            }
        }
        
        return $scan;
    }
    
    /**
     * Save certification record to JSON file
     */
    private function saveCertificationRecord($certification) {
        $records = $this->loadCertificationRecords();
        $records[] = $certification;
        
        file_put_contents(
            $this->certifiedImagesFile, 
            json_encode($records, JSON_PRETTY_PRINT)
        );
    }
    
    /**
     * Load certification records from JSON file
     */
    private function loadCertificationRecords() {
        if (!file_exists($this->certifiedImagesFile)) {
            return [];
        }
        
        $content = file_get_contents($this->certifiedImagesFile);
        return json_decode($content, true) ?: [];
    }
    
    /**
     * Check if image is certified
     */
    public function isCertified($imagePath) {
        $records = $this->loadCertificationRecords();
        
        foreach ($records as $record) {
            if ($record['image_path'] === $imagePath) {
                // Verify file hasn't been modified
                $currentHash = hash_file('sha256', $imagePath);
                if ($currentHash === $record['file_hash']) {
                    return $record;
                }
            }
        }
        
        return false;
    }
    
    /**
     * Get all certified images
     */
    public function getCertifiedImages() {
        return $this->loadCertificationRecords();
    }
    
    /**
     * Bulk certify all images in directory
     */
    public function certifyAllImages($directory = null) {
        $directory = $directory ?: $this->imageBasePath;
        $results = [
            'certified' => [],
            'failed' => [],
            'total_processed' => 0
        ];
        
        if (!is_dir($directory)) {
            return $results;
        }
        
        $files = scandir($directory);
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            
            $filePath = $directory . $file;
            if (is_file($filePath)) {
                $results['total_processed']++;
                
                $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                if (in_array($extension, $this->allowedExtensions)) {
                    $certification = $this->certifyImage($filePath, pathinfo($file, PATHINFO_FILENAME));
                    
                    if ($certification['certified']) {
                        $results['certified'][] = [
                            'file' => $file,
                            'certification_id' => $certification['certification_id']
                        ];
                    } else {
                        $results['failed'][] = [
                            'file' => $file,
                            'errors' => $certification['errors']
                        ];
                    }
                }
            }
        }
        
        return $results;
    }
    
    /**
     * Generate certification report
     */
    public function generateCertificationReport() {
        $records = $this->loadCertificationRecords();
        $report = [
            'total_certified' => count($records),
            'certification_date' => date('Y-m-d H:i:s'),
            'images' => []
        ];
        
        foreach ($records as $record) {
            $report['images'][] = [
                'certification_id' => $record['certification_id'],
                'image_path' => $record['image_path'],
                'product_name' => $record['product_name'],
                'certified_at' => $record['certified_at'],
                'dimensions' => $record['metadata']['width'] . 'x' . $record['metadata']['height'],
                'file_size' => round($record['metadata']['file_size'] / 1024, 2) . ' KB',
                'security_clean' => $record['security_scan']['clean'] ? 'Yes' : 'No'
            ];
        }
        
        return $report;
    }
}

/**
 * Helper function to get certified image path
 */
function getCertifiedImagePath($imagePath) {
    static $certSystem = null;
    if ($certSystem === null) {
        $certSystem = new ImageCertificationSystem();
    }
    
    $certification = $certSystem->isCertified($imagePath);
    if ($certification) {
        return $imagePath;
    }
    
    // Return placeholder for non-certified images
    return 'assets/images/placeholder.jpg';
}

/**
 * Helper function to validate product image
 */
function validateProductImage($imagePath) {
    static $certSystem = null;
    if ($certSystem === null) {
        $certSystem = new ImageCertificationSystem();
    }
    
    return $certSystem->validateImage($imagePath);
}
?>