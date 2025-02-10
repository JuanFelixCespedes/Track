    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo (isset($tripdetails))?'Edit Booking':'Add Booking' ?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Vehicle</a></li>
              <li class="breadcrumb-item active"><?php echo (isset($tripdetails))?'Edit Booking':'Add Booking' ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form method="post" id="trip_add" class="card"  action="<?php echo base_url();?>Trips/<?php echo (isset($tripdetails))?'updatetrips':'inserttrips'; ?>">
         <div class="card-body">
            <div class="row">
               <input type="hidden" name="t_id" id="t_id" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_id']:'' ?>" >               
                          
               <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                          <label class="form-label">Nombre<span class="form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_customer_id']:'' ?>" id="t_customer_id" name="t_customer_id" placeholder="Customer Name">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                         <label class="form-label">Telefono<span class="form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_tel']:'' ?>" id="t_tel" name="t_tel" placeholder="Customer Mobile">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                         <label class="form-label">Producto<span class="form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_producto']:'' ?>" id="t_producto" name="t_producto" placeholder="Customer Mobile">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Total Amount<span class="form-required">*</span></label>
                     <input type="text" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_trip_amount']:'' ?>" name="t_trip_amount" value="" class="form-control" placeholder="Total Amount">
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Trip End Location<span class="form-required">*</span></label>
                     <input type="text" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_trip_tolocation']:'' ?>" name="t_trip_tolocation" id="t_trip_tolocation" class="form-control" placeholder="Trip End Location">
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Approx Total KM<span class="form-required">*</span></label>
                     <input type="text" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_totaldistance']:'' ?>" readonly="true" name="t_totaldistance" id="t_totaldistance" class="form-control" placeholder="Approx Total KM">
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Trip Start Date<span class="form-required">*</span></label>
                     <input type="text" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_start_date']:'' ?>" name="t_start_date" value="" class="form-control datepicker" placeholder="Trip Start Date">
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Trip End Date<span class="form-required">*</span></label>
                     <input type="text" value="<?php echo (isset($tripdetails)) ? $tripdetails[0]['t_end_date']:'' ?>" name="t_end_date" value="" class="form-control datepicker" placeholder="Trip End Date">
                  </div>
               </div>
                              
              
                <?php if(!isset($tripdetails)) {  ?>
                <div class="col-sm-6 col-md-5">
                 <div class="form-group">
                     <label class="form-label">Email</label>
                <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="1" name="bookingemail" id="bookingemail" class="custom-control-input" id="bookingemail">
                      <label class="custom-control-label" for="bookingemail">Is need to sent Booking confirmation email to customer?</label>
                    </div>
                  </div>
            </div>
             </div>
           <?php } ?>

            </div>

            <input type="hidden" id="t_trip_status" name="t_trip_status" value="yettostart">
            <input type="hidden" id="t_trip_fromlocation" name="t_trip_fromlocation" value="Jirón Enrique Barrón 1090, Lima, Perú">
            <input type="hidden" id="t_type" name="t_type" value="singletrip">
            <input type="hidden" id="t_vechicle" name="t_vechicle" value="0">
            <input type="hidden" id="t_driver" name="t_driver" value="1">            
            <input type="hidden" id="t_trip_fromlat" name="t_trip_fromlat" value="-12.0748522">
            <input type="hidden" id="t_trip_fromlog" name="t_trip_fromlog" value="-77.0332686">
            <input type="hidden" id="t_trip_tolat" name="t_trip_tolat" value="1">
            <input type="hidden" id="t_trip_tolog" name="t_trip_tolog" value="1">
            <input type="hidden" id="t_created_by" name="t_created_by" value="<?php echo output($this->session->userdata['session_data']['u_id']); ?>">
            <input type="hidden" id="t_created_date" name="t_created_date" value="<?php echo date('Y-m-d h:i:s'); ?>">
            <div class="card-footer text-right">
               <button type="submit" class="btn btn-primary"> <?php echo (isset($tripdetails))?'Update Trip':'Add Trip' ?></button>
            </div>
      </form>
             </div>
    </section>
    <!-- /.content -->



