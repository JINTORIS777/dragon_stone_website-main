<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dragon Stone - Image Certification Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #1b4d3e, #a5c9a1); min-height: 100vh; }
        .admin-header { background: rgba(0,0,0,0.7); color: white; padding: 20px 0; }
        .admin-card { background: rgba(255,255,255,0.95); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1><i class="fas fa-shield-check me-3"></i>Dragon Stone</h1>
                    <h2>Image Certification System</h2>
                    <p class="lead">Security & Validation Dashboard</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="admin-card rounded p-5">
                    
                    <?php
                    require_once 'image_certification.php';
                    
                    $certSystem = new ImageCertificationSystem();
                    
                    // Check if certification file exists
                    if (file_exists('certified_images.json')) {
                        $certData = json_decode(file_get_contents('certified_images.json'), true);
                        $totalCertified = count($certData);
                        
                        echo '<div class="alert alert-success" role="alert">';
                        echo '<h4 class="alert-heading"><i class="fas fa-check-circle me-2"></i>Certification System Active!</h4>';
                        echo '<p>The Dragon Stone image certification system is operational and has certified <strong>' . $totalCertified . ' images</strong>.</p>';
                        echo '<hr>';
                        echo '<p class="mb-0">All product images have been validated for security and integrity.</p>';
                        echo '</div>';
                        
                        echo '<div class="row mb-4">';
                        echo '<div class="col-md-4">';
                        echo '<div class="text-center p-3 border rounded bg-light">';
                        echo '<i class="fas fa-images fa-2x text-primary mb-2"></i>';
                        echo '<h5>' . $totalCertified . '</h5>';
                        echo '<p class="text-muted">Certified Images</p>';
                        echo '</div>';
                        echo '</div>';
                        
                        // Count secure images
                        $secureCount = 0;
                        foreach ($certData as $cert) {
                            if ($cert['security_scan']['clean']) $secureCount++;
                        }
                        
                        echo '<div class="col-md-4">';
                        echo '<div class="text-center p-3 border rounded bg-light">';
                        echo '<i class="fas fa-shield-alt fa-2x text-success mb-2"></i>';
                        echo '<h5>' . $secureCount . '</h5>';
                        echo '<p class="text-muted">Security Verified</p>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="col-md-4">';
                        echo '<div class="text-center p-3 border rounded bg-light">';
                        echo '<i class="fas fa-percentage fa-2x text-info mb-2"></i>';
                        echo '<h5>' . round(($secureCount / $totalCertified) * 100) . '%</h5>';
                        echo '<p class="text-muted">Security Score</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        
                        // Show recent certifications
                        echo '<h5><i class="fas fa-clock me-2"></i>Recent Certifications</h5>';
                        echo '<div class="table-responsive">';
                        echo '<table class="table table-striped">';
                        echo '<thead><tr><th>Image</th><th>Certification ID</th><th>Security</th><th>Date</th></tr></thead>';
                        echo '<tbody>';
                        
                        $recentCerts = array_slice($certData, -10); // Last 10 certifications
                        foreach ($recentCerts as $cert) {
                            echo '<tr>';
                            echo '<td><small>' . htmlspecialchars(basename($cert['image_path'])) . '</small></td>';
                            echo '<td><code style="font-size:0.7rem;">' . htmlspecialchars(substr($cert['certification_id'], 0, 20)) . '...</code></td>';
                            if ($cert['security_scan']['clean']) {
                                echo '<td><span class="badge bg-success"><i class="fas fa-check"></i> Clean</span></td>';
                            } else {
                                echo '<td><span class="badge bg-warning"><i class="fas fa-exclamation-triangle"></i> Warning</span></td>';
                            }
                            echo '<td><small>' . date('M j, H:i', strtotime($cert['certified_at'])) . '</small></td>';
                            echo '</tr>';
                        }
                        
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                        
                    } else {
                        echo '<div class="alert alert-warning" role="alert">';
                        echo '<h4 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Certification Needed</h4>';
                        echo '<p>The image certification system needs to be initialized.</p>';
                        echo '<hr>';
                        echo '<a href="certify_images.php" class="btn btn-warning">Run Image Certification</a>';
                        echo '</div>';
                    }
                    ?>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6><i class="fas fa-info-circle me-2"></i>What is Image Certification?</h6>
                            <p class="small text-muted">
                                Our image certification system validates each image for:
                            </p>
                            <ul class="small text-muted">
                                <li>File integrity and format validation</li>
                                <li>Security scanning for malicious content</li>
                                <li>Metadata verification and size optimization</li>
                                <li>Unique certification ID generation</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-cogs me-2"></i>System Actions</h6>
                            <div class="d-grid gap-2">
                                <a href="certification_dashboard.php" class="btn btn-primary btn-sm">
                                    <i class="fas fa-tachometer-alt me-2"></i>View Full Dashboard
                                </a>
                                <a href="index.php" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-home me-2"></i>Back to Website
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center py-3">
                <small class="text-white opacity-75">
                    Dragon Stone Image Certification System | Powered by Advanced Security Validation
                </small>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>