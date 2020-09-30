<?php
 include('./dashboard_header.php');
 include('./dashboard_sidebar.php');
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
 <!--new code copy-->
 <button type="button"  class="new_button"> <a href="./all_categories.php">Back</a></button>
 <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Coupan</strong><small> Insert</small></div>
                       
                        <div class="card-body card-block">
                        <form method="post" action="add_categories.php">
                           <div class="form-group"><label class=" form-control-label">Coupan name 
                           <span style="color:red; font-size:28px;">*</span>
                           </label><input type="text" name="cat_name" placeholder="Enter your Categories name" class="form-control"></div>

                           <div class="form-group"><label class=" form-control-label">Coupan Description
                           <span style="color:red; font-size:28px;">*</span>
                           </label>  <textarea class="form-control"  name="cat_desc" rows="4"></textarea>          
                          
                           <div class="form-group">
									<label for="categories" class=" form-control-label">Discount</label>
									<select class="form-control" name="categories_id">
										<option>Select</option>
										<option value="10">10%</option>
										<option value="20">20</option>
                                        <option value="30">30%</option>
										<option value="50">50%</option>
									</select>
								</div>

                                <div class="form-group"><label class=" form-control-label">Expire Date
                           <span style="color:red; font-size:28px;">*</span>
                           </label><input type="date" name="cat_name" class="form-control"></div>

                           <button name="apply" type="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Generate</span>
                           </button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

        
  </div>
  
 
<?php 
    include('./dashboard_footer.php');
?>