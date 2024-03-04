<?php

/*
 * package   OpenEMR
 * link      http://www.open-emr.org
 * author    Sherwin Gaddis <sherwingaddis@gmail.com>
 * Copyright (c) 2023.
 * license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once dirname(__FILE__, 5) . '/globals.php';

use OpenEMR\Core\Header;

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo xlt('Welcome to HealthScribe') ?></title>
    <?php Header::setupHeader(); ?>
</head>
<body>
<div class = "container">
    <div class = "row">
        <div class = "col-md-12">
            <h1><?php echo xlt('Welcome to HealthScribe') ?></h1>
        </div>
    </div>
    <div class = "row">
        <div class = "col-md-12">
            <h3><?php echo xlt('Enhance clinician productivity with AI-generated insights') ?></h3>
            <p><?php echo xlt('HealthScribe is a module for OpenEMR that provides a way to document patient encounters using voice recognition.') ?></p>
            <p><?php echo xlt('Automatically create clinical notes from patient-clinician conversations using generative AI.'); ?></p>
            <p><?php echo xlt("Transcribe patient visits, generate preliminary clinical notes, and extract insights that help clinicians to quickly revisit highlights of their patient visits and easily accept, reject, or edit content suggestions."); ?></p>
            <h3><?php echo xlt('Safeguard patient privacy using a HIPAA-eligible service') ?></h3>
            <p><?php echo xlt('Built with security and privacy in mind, you control where your data is stored, with data encrypted in transit and at rest. AWS does not use inputs or outputs generated through the service to train its models.') ?></p>
        </div>
        <div class = "col-md-12">
            <h3><?php echo xlt('Get started') ?></h3>
            <p><?php echo xlt('To get started, you will need to register a payment method. When you register a payment method, use the same email address to sign into the application.') ?></p>
            <p><a href="https://api.affordablecustomehr.com/stripe/" target="_blank"><h3><?php echo xlt('Register') ?></h3></a></p>
            <p><?php echo xlt('Once you have registered a payment method, you are ready to start') ?></p>
            <p><strong><?php echo xlt('Cost $0.45 per minute of recording')?>. </strong><br>
                    <?php echo xlt('To minimize audio storage charges, delete audio after transcriptions is completed.') ?></p>
            <p class="text-center"><?php echo htmlspecialchars("Privacy Policy", ENT_QUOTES, 'UTF-8'); ?>: <a href="<?php echo htmlspecialchars("https://www.affordablecustomehr.com/privacy", ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars("Privacy Policy", ENT_QUOTES, 'UTF-8'); ?></a></p>
            <p class="text-center"><?php echo htmlspecialchars('Business Associates Agreement ')?>: <a href="<?php echo htmlspecialchars("https://www.affordablecustomehr.com/baa", ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars("BAA Form", ENT_QUOTES, 'UTF-8'); ?></a></p>
        </div>
</body>
<script>
</script>
</html>
