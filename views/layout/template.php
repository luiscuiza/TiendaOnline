<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title ?? 'Tienda Online'; ?></title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <link rel="stylesheet" href="/assets/css/switchbutton.css">
        <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
        <link rel="icon" href="/assets/dist/img/icon.png">
        <?php echo $headCss ?? ''; ?>
        <?php echo $headJs ?? ''; ?>
    </head>
    <body> 
        <?php
            if (!empty($sidebar)) {
                include $sidebar;
            } else {
                echo $content ?? '';
            }
        ?>
        <?php echo $bodyCss ?? ''; ?>
        <script src="/assets/plugins/jquery/jquery.min.js"></script>
        <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/dist/js/adminlte.min.js"></script>
        <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="/assets/plugins/jquery-validation/additional-methods.min.js"></script>
        <script src="/assets/plugins/jquery-validation/localization/messages_es.js"></script>
        <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="/assets/plugins/jszip/jszip.min.js"></script>
        <script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
        <?php echo $bodyJs ?? ''; ?>
    </body>
</html>
