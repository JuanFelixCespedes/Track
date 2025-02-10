    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bookings
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
                          <th>Empresa</th>
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
                            <td> <?= (isset($triplists['t_user_details']->u_name))?$triplists['t_user_details']->u_name:'<span class="badge badge-danger">Yet to Assign</span>'; ?></td>
                             <?php if(userpermission('lr_trips_list_edit')) { ?>
                               <td>
                            <a class="icon" href="<?php echo base_url(); ?>trips/edittrip/<?php echo output($triplists['t_id']); ?>">
                              <i class="fa fa-edit"></i>
                            </a> 
                            <a class="icon" href="<?php echo base_url(); ?>trips/details/<?php echo output($triplists['t_id']); ?>">
                              <i class="fa fa-eye"></i>
                            </a>
                            
                            <a data-toggle="modal" data-id=<?php echo output($triplists['t_id']); ?> title="Add this item" class="open-AddBookDialog icon" href="#addBookDialog"> <i class="fa fa-check"></i></a>

                            <a data-toggle="modal" data-id=<?php echo output($triplists['t_id']); ?> title="Add this item" class="open-Statusbook icon" href="#Statusbook"> <i class="fa fa-hourglass-start"></i></a>

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

      </div>
      
             </div>
             
             
    </section>
    <!-- /.Drivers --> 
<div class="modal hiden" id="addBookDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" id="trip_add"   action="<?php echo base_url();?>Trips/<?php echo (isset($tripdetails))?'updatetrips':'updatetrips'; ?>">
                
              <p class="text-primary">Todos los campos son obligatorios.</p>  
              <input type="text" name="t_id" id="t_id" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_id']:'' ?>" >
                    <div class="row">                                           
                        <div class="col-lg-12">
                          <div class="form-group">
                          <label class="form-label">Vechicle<span class="form-required">*</span></label>
                            <select id="t_vechicle"  class="form-control"  name="t_vechicle" >
                                <option value="">Select Vechicle</option>
                                <?php  foreach ($vechiclelist as $key => $vechiclelists) { ?>
                                <option <?php if((isset($tripdetails)) && $tripdetails[0]['t_vechicle'] == $vechiclelists['v_id']){ echo 'selected';} ?> value="<?php echo output($vechiclelists['v_id']) ?>"><?php echo output($vechiclelists['v_name']).' - '. output($vechiclelists['v_registration_no']); ?></option>
                                <?php  } ?>
                            </select>                                  
                          </div>
                        </div>
                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"> <?php echo (isset($tripdetails))?'Update Trip':'Update Trip' ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Drivers-->

<!-- /.Status -->   
<div class="modal hiden" id="Statusbook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" id="trip_add"   action="<?php echo base_url();?>Trips/<?php echo (isset($tripdetails))?'updatetrips':'updatetrips'; ?>">
                
              <p class="text-primary">Todos los campos son obligatorios.</p>  
              <input type="text" name="t_id" id="t_id" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_id']:'' ?>" >
                    <div class="row">                                           
                        <div class="col-lg-12">
                          <div class="form-group">
                          <label class="form-label">Trip Status</label>
                            <select name="t_trip_status" id="t_trip_status" required="true" class="form-control">
                              <option value="yettostart">Trip Status</option>
                              <option <?php if((isset($tripdetails)) && $tripdetails[0]['t_trip_status'] == 'completed'){ echo 'selected';} ?> value="completed">Completed</option>
                              <option <?php if((isset($tripdetails)) && $tripdetails[0]['t_trip_status'] =='ongoing'){ echo 'selected';} ?> value="ongoing">Ongoing</option>
                              <option <?php if((isset($tripdetails)) && $tripdetails[0]['t_trip_status'] =='cancelled'){ echo 'selected';} ?> value="cancelled">Cancelled</option>
                            </select>                               
                          </div>
                        </div>
                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"> <?php echo (isset($tripdetails))?'Update Trip':'Update Trip' ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Status-->
<script>   

 $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #t_id").val( myBookId );    
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});

$(document).on("click", ".open-Statusbook", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #t_id").val( myBookId );    
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});

</script>



