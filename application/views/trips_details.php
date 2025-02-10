    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pedidos Detalles
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Booking Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    <div class="card">
      <?php
      $totalpaidamt = 0;
      if(count($paymentdetails)>=1) {
      foreach ($paymentdetails as $payment) {
          $totalpaidamt += $payment['tp_amount'];
      } }
      ?>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Monto Total</span>
                      <span class="info-box-number text-center text-muted mb-0"><?= $tripdetails['t_trip_amount']; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Monto de Pago</span>
                      <span class="info-box-number text-center text-muted mb-0"><?= $totalpaidamt; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted"><?= ($tripdetails['t_trip_amount'] > $totalpaidamt)?'Pendiente':'Excess' ?></span>
                      <span class="info-box-number text-center text-muted mb-0"><?= preg_replace('/[^\d\.]+/','',$tripdetails['t_trip_amount'] - $totalpaidamt)  ?> <span>
                    </span></span></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h4>Descripción general:</h4>
                    <div class="post">
                      <div class="row">
                      <div class="col-lg-5">
                      <div class="user-block">
                        <span class="username">
                          <?= $tripdetails['t_trip_fromlocation']; ?>
                        </span>
                        <span class="description"><?= $tripdetails['t_start_date']; ?></span>
                      </div>
                    </div> a
                     <div class="col-lg-5">
                      <div class="user-block">
                        <span class="username">
                          <?= $tripdetails['t_trip_tolocation']; ?>
                        </span>
                        <span class="description"><?= $tripdetails['t_end_date']; ?></span>
                      </div>
                       </div>
                        <div class="col-lg-4"></div>
                        <?php 
                        if($tripdetails['t_totaldistance']!='') {
                          if($tripdetails['t_type']=='single') { $dist = $tripdetails['t_totaldistance']; } else { $dist = $tripdetails['t_totaldistance']*2; }  ?>
                          <?= $tripdetails['t_type']; ?> Con Un Total de <?= $dist; ?> km 
                        <?php } ?>
                     </div>
                    </div>

               

                     <h5>Actividad de pago:</h5>
                    <div class="post clearfix">
                      <?php if(!empty($paymentdetails)) { ?>
                   <table class="table table-bordered table-sm">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Cantidad</th>
                      <th>Comentarios</th>
                      <th>Pagado</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $count=1;
                           foreach($paymentdetails as $paymentdetails){ ?>
                      <tr>
                      <td><?php echo output($count); $count++; ?></td>
                      <td><?php echo output($paymentdetails['tp_amount']); ?></td>
                      <td><?php echo output($paymentdetails['tp_notes']); ?></td>
                      <td><?php echo output($paymentdetails['tp_created_date']); ?></td>
                      <td>
                        <a class="icon" href="<?php echo base_url(); ?>trips/trippayment_delete/<?php echo output($paymentdetails['tp_id']); ?>/<?= $tripdetails['t_id']; ?>"><i class="fa fa-trash text-danger"></i></a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                 <?php 
                     }  
                     else
                     {
                     echo '<div class="alert alert-warning">¡No se encontraron detalles de pago!.</div><div style="padding-bottom:240px"></div>';
                     }
                     ?>
                </div>
                </div>

              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <div class="mt-2 mb-3">
                <a href="#" class="btn btn-sm btn-success <?= ($tripdetails['t_trip_amount'] - $totalpaidamt==0)?'disabled':'' ?>" data-toggle="modal" data-target="#modal-AddPayment">Agregar Pago</a>
                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tripexpense">Gastos de Viaje</a>
                <a href="<?= base_url(); ?>trips/invoice/<?= $tripdetails['t_id']; ?>" target="_blank" class="btn btn-sm btn-success" >Generar Documento</a>
              </div> 
              <br>
              <div class="text-muted">
                <p class="text-sm">Información del cliente
                  <b class="d-block"><?= $tripdetails['t_customer_id']; ?></b>
                  <!--<b class="d-block"><?= $tripdetails['t_tel']; ?></b>-->
                  <a class="d-block" href="tel:<?= $tripdetails['t_tel']; ?>">Llamar: <?= $tripdetails['t_tel']; ?></a>
                  <a class="d-block" href="https://api.whatsapp.com/send?phone=<?= $tripdetails['t_tel']; ?>">Whatsapp: <?= $tripdetails['t_tel']; ?></a>
                  <!--<b class="d-block"><?= $customerdetails['c_email']; ?></b> -->
                  <b class="d-block"><?= $tripdetails['t_trip_tolocation']; ?></b>
                </p>
                <p class="text-sm">Información del conductor
                  <?php if(isset($driverdetails['d_name'])) { ?>
                  <b class="d-block"><?= $driverdetails['d_name']; ?></b>
                  <b class="d-block"><?= $driverdetails['d_mobile']; ?></b>
                  <b class="d-block"><?= $driverdetails['d_licenseno']; ?></b>
                  <?php  } else { echo '<b class="d-block"><span class="badge badge-danger">Yet to Assign</span></b>'; } ?>
                </p>
                 <p class="text-sm">Ubicacion
                  <b class="d-block"><a target="_new" href="https://waze.com/ul?ll=<?= $tripdetails['t_trip_tolat']; ?>,<?= $tripdetails['t_trip_tolog']; ?>&z=10">Waze</a></b>
                  <b class="d-block"><a target="_new" href="https://www.google.com/maps/dir//<?= $tripdetails['t_trip_tolat']; ?>,<?= $tripdetails['t_trip_tolog']; ?>?entry=ttu">Google Maps</a></b>
                  <b class="d-block"><a target="_new" href="<?= base_url().'triptracking/'.$tripdetails['t_trackingcode']; ?>"><?= base_url().'triptracking/'.$tripdetails['t_trackingcode']; ?></a></b>
                </p>
                <p><div class="col-6"><a href="https://api.whatsapp.com/send?phone=<?= $tripdetails['t_tel']; ?>&text=Su%20envio%20de%20EMPRESA%20sera%20entregado%20HOY%20en%20transcurso%20del%20dia%20,%20Puede%20Revisar%20su%20pedido%20al%20siguiente%20link:%20<?= base_url().'triptracking/'.$tripdetails['t_trackingcode']; ?>" class="btn btn-sm btn-success">Compartir</a></div></p>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      </div>
    </section>
<div class="modal fade show" id="modal-AddPayment" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hacer el pago</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="trippayments" action="<?= base_url() ?>trips/trippayment" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="totalamount" class="col-sm-4 col-form-label">Monto Total</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="totalamount" value="<?= $tripdetails['t_trip_amount']; ?>" id="totalamount" placeholder="Enter totalamount" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="paidamount" class="col-sm-4 col-form-label">Monto Pendiente</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="pendingamount" value="<?= $tripdetails['t_trip_amount']-$totalpaidamt; ?>" id="pendingamount" placeholder="Paid Amount" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tp_amount" class="col-sm-4 col-form-label">Pago</label>
                    <div class="form-group col-sm-8">
                       <input type="text" class="form-control" name="tp_amount" id="tp_amount" placeholder="Pay">
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="tp_notes" class="col-sm-4 col-form-label">Descripcion</label>
                    <div class="form-group col-sm-8">
                      <textarea class="form-control" id="tp_notes" name="tp_notes" rows="2" placeholder="Enter Notes"></textarea>
                    </div>
                  </div>
                </div>
                 <input type="hidden" class="form-control" value="<?= $tripdetails['t_id']; ?>" name="tp_trip_id" id="tp_trip_id" placeholder="tp_trip_id">
                 <input type="hidden" class="form-control" value="<?= $tripdetails['t_vechicle']; ?>" name="tp_v_id" id="tp_v_id" placeholder="tp_v_id">
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<div class="modal fade show" id="modal-tripexpense" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar gastos de viaje</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="addtripexpense" action="<?= base_url() ?>trips/addtripexpense" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="ie_amount" class="col-sm-4 col-form-label">Cantidad</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" pattern="^[0-9]*$" required="true" name="ie_amount" id="ie_amount" placeholder="Ingresar Gastos">
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="ie_description" class="col-sm-4 col-form-label">Notas</label>
                    <div class="form-group col-sm-8">
                      <textarea class="form-control" required="true" id="ie_description" name="ie_description" rows="2" placeholder="Ingresar Notas"></textarea>
                    </div>
                  </div>
                </div>
                 <input type="hidden" class="form-control" value="<?= $tripdetails['t_start_date']; ?>" name="ie_date" id="ie_date">
                 <input type="hidden" class="form-control" value="<?= $tripdetails['t_vechicle']; ?>" name="ie_v_id" id="ie_v_id">
                 <input type="hidden" class="form-control" value="expense" name="ie_type" id="ie_type">
                 <input type="hidden" class="form-control" value="<?= $tripdetails['t_id']; ?>" name="addtripexpense_trip_id" id="addtripexpense_trip_id">
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>