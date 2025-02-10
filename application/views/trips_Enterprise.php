    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pedidos Empresa
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Bookings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    <div class="card">

        <div class="card-body p-0">
          

         <div class="table-responsive">
                    <table id="triptbl" class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No</th>
                          <th>Cliente</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Vechicle</th>     
                          <th>Estado</th>
                           <?php if(userpermission('lr_trips_list_edit')) { ?>
                          <th>Action</th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      <?php if(!empty($triplist)){ 
                           $count=1;
                           foreach($triplist as $triplists){
                           ?>
                        <tr>
                        <td> <?php echo output($count); $count++; ?></td>
                           <td> <?php echo ucfirst($triplists['t_customer_id']); ?></td>
                           <td> <?php echo ucfirst($triplists['t_producto']); ?></td>
                           <td> <?php echo ucfirst($triplists['t_trip_amount']); ?></td>
                           <td> <?= (isset($triplists['t_vechicle_details']->v_name))?$triplists['t_vechicle_details']->v_name:'<span class="badge badge-danger">Yet to Assign</span>'; ?> </td>
                           <td> <?php 
                              switch($triplists['t_trip_status']){
                                  case 'ongoing':
                                      $status = '<span class="badge badge-info">Ongoing</span>';
                                      break;
                                  case 'completed':
                                      $status = '<span class="badge badge-success">Completed</span>';
                                       break;
                                  case 'yettostart':
                                      $status = '<span class="badge badge-warning">Yet to start</span>';
                                       break;
                                  case 'cancelled':
                                      $status = '<span class="badge badge-danger">Cancelled</span>'; 
                                       break; 
                                  case 'yettoconfirm':
                                      $status = '<span class="badge badge-danger">Yet to Confirm</span>'; 
                                       break;    
                                }

                              ?>
                             <?=  $status ?>  
                            </td>
                             <?php if(userpermission('lr_trips_list_edit')) { ?>
                               <td>
                            <a class="icon" href="<?php echo base_url(); ?>trips/edittrip/<?php echo output($triplists['t_id']); ?>">
                              <i class="fa fa-edit"></i>
                            </a> 
                            
                          </td>
                          <?php } ?>
                        </tr>
                        <?php } } ?>
                      </tbody>
                    </table>
                   
        </div>         
        </div>
        <!-- /.card-body -->
      </div>
      
             </div>
    </section>
    <!-- /.content -->



