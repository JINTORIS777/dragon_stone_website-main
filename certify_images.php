<?php
/**
 * Certify All Images Script
 * Run this script to certify all images in the Dragon Stone website
 */

require_once 'image_certification.php';

echo "=== Dragon Stone Image Certification System ===\n";
echo "Starting image certification process...\n\n";

// Initialize certification system
$certSystem = new ImageCertificationSystem();

// Certify all images in the assets/images directory
echo "Certifying images in assets/images/ directory...\n";
$results = $certSystem->certifyAllImages('assets/images/');

echo "Certification Results:\n";
echo "- Total files processed: " . $results['total_processed'] . "\n";
echo "- Successfully certified: " . count($results['certified']) . "\n";
echo "- Failed certification: " . count($results['failed']) . "\n\n";

if (!empty($results['certified'])) {
    echo "Successfully Certified Images:\n";
    foreach ($results['certified'] as $cert) {
        echo "  ✓ " . $cert['file'] . " (ID: " . $cert['certification_id'] . ")\n";
    }
    echo "\n";
}

if (!empty($results['failed'])) {
    echo "Failed Certifications:\n";
    foreach ($results['failed'] as $fail) {
        echo "  ✗ " . $fail['file'] . "\n";
        foreach ($fail['errors'] as $error) {
            echo "    - " . $error . "\n";
        }
    }
    echo "\n";
}

// Generate certification report
echo "Generating certification report...\n";
$report = $certSystem->generateCertificationReport();

echo "\n=== CERTIFICATION REPORT ===\n";
echo "Total Certified Images: " . $report['total_certified'] . "\n";
echo "Report Generated: " . $report['certification_date'] . "\n\n";

if (!empty($report['images'])) {
    echo "Certified Images Details:\n";
    echo str_pad("CERT ID", 25) . str_pad("IMAGE", 30) . str_pad("DIMENSIONS", 15) . str_pad("SIZE", 10) . "SECURE\n";
    echo str_repeat("-", 80) . "\n";
    
    foreach ($report['images'] as $img) {
        echo str_pad(substr($img['certification_id'], 0, 24), 25) . 
             str_pad(substr(basename($img['image_path']), 0, 29), 30) . 
             str_pad($img['dimensions'], 15) . 
             str_pad($img['file_size'], 10) . 
             $img['security_clean'] . "\n";
    }
}

echo "\nCertification completed successfully!\n";
echo "Certification records saved to: certified_images.json\n";

// Also create a placeholder image if it doesn't exist
$placeholderPath = 'assets/images/placeholder.jpg';
if (!file_exists($placeholderPath)) {
    echo "\nCreating placeholder image...\n";
    
    // Create a simple placeholder image
    $width = 400;
    $height = 300;
    $image = imagecreate($width, $height);
    
    // Define colors
    $bg_color = imagecolorallocate($image, 240, 240, 240);
    $text_color = imagecolorallocate($image, 100, 100, 100);
    $border_color = imagecolorallocate($image, 200, 200, 200);
    
    // Fill background
    imagefill($image, 0, 0, $bg_color);
    
    // Draw border
    imagerectangle($image, 0, 0, $width-1, $height-1, $border_color);
    
    // Add text
    $text = "PLACEHOLDER";
    $font_size = 16;
    
    // Center the text
    $text_width = strlen($text) * imagefontwidth($font_size);
    $text_height = imagefontheight($font_size);
    $x = ($width - $text_width) / 2;
    $y = ($height - $text_height) / 2;
    
    imagestring($image, $font_size, $x, $y, $text, $text_color);
    
    // Save the image
    imagejpeg($image, $placeholderPath, 80);
    imagedestroy($image);
    
    echo "Placeholder image created at: " . $placeholderPath . "\n";
    
    // Certify the placeholder
    $placeholderCert = $certSystem->certifyImage($placeholderPath, 'Placeholder Image');
    if ($placeholderCert['certified']) {
        echo "Placeholder image certified with ID: " . $placeholderCert['certification_id'] . "\n";
    }
}

echo "\n=== CERTIFICATION PROCESS COMPLETE ===\n";
?>