<?= require_once('components/sidebar.php') ?>

<!-- mostrar la notificacion de registro exitoso -->
<?php
if ($this->session->flashdata('success')) {                        
?>
<script>
Swal.fire({
    title: 'Perfecto!',
    text: '<?= $this->session->flashdata('success')?>',
    icon: 'success',
    confirmButtonText: 'Aceptar'
});
</script>

<?php                            
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tables</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Sedes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Nombre de Sede</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>


<?= require_once('components/footer.php') ?>