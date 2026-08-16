<?php
if (!isset($pageTitle)) $pageTitle = '';
if (!isset($pageDesc)) $pageDesc = 'Agence Congolaise de Normalisation et de la Qualité - Normalisation, métrologie et évaluation de la conformité au Congo.';
if (!isset($pageImage)) $pageImage = 'aconoq_logo.png';

if ($pageTitle === '' || $pageTitle === 'ACONOQ') {
    $fullTitle = 'ACONOQ : Agence Congolaise de Normalisation et de la Qualité';
} else {
    $fullTitle = $pageTitle . ' - ACONOQ';
}
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $fullTitle; ?></title>
<meta name="description" content="<?php echo htmlspecialchars($pageDesc); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($fullTitle); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($pageDesc); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($pageImage); ?>">
<meta property="og:site_name" content="ACONOQ">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="css/apsi-design.css">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#0f7140',
                    'primary-dark': '#0a4b2a',
                    'primary-light': '#eaf4ef',
                    'lime': '#c5e84a',
                    'dark': '#0a1f0a',
                    'gray-text': '#4a5a4c',
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                    serif: ['Inter', 'sans-serif'],
                }
            }
        }
    }
</script>
