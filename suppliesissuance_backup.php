<style>

  .space {
  width: 50px;
  height: auto;
  display: inline-block;
}
</style>  

<?php 
  require_once('startsession.php');
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
  include('db_connect.php');

  include('header.php');
  include ('topbar.php'); 
  include ('navbar.php'); 
  include ('utils.php');
  $tamt = 0;
?>

<main id="view-panel" >

<div class="container-fluid" >
    <div class="col-lg-12">
        <br />
        <br />
        <div class="card">
          <div class="card-header">
            <div>
            <span><b>Supplies Issuance </b></span>
          </div>  
          <div class="card-body">
          <br>
          <form>   
          <div class="row">
              <div class="form-group col-md-2" style="padding-left:30px">
                <label>Control No</label>
                <input type="text" name="cr_number" id="cr_number" required="required" class="form-control text-left" />'
              </div>

              <div class="form-group col-md-4" style="padding-left:30px">
                <label>Department</label>
                <select class="custom-select browser-default " name="department" id="department" >
                  <option value=""></option>
                  <?php
                    $item = $conn->query("SELECT * from department order by id asc");
                      while($row=$item->fetch_assoc()):
                  ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($id) && $id == $row['id'] ? "selected" :"" ?>><?php echo $row['name'].' ('.$row['id'].')' ?></option> 
                      <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group col-md-2" style="padding-left:30px">
                <label>Issuance Date</label>
                <input type="text" name="tran_date" id="tran_date"  required="required" class="form-control text-right" onfocus="(this.type='date')" step="any"  />
              </div>
              <div class="form-group col-md-4" style="padding-left:30px">
                <label>Item</label>
                <select class="custom-select browser-default " name="item_id" id="item_id" >
                  <option value=""></option>
                  <?php
                    $item = $conn->query("SELECT * from supplies_master order by item_description asc");
                      while($row=$item->fetch_assoc()):
                  ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($item_id) && $item_id == $row['id'] ? "selected" :"" ?>><?php echo $row['item_description'].' ('.$row['item_code'].')' ?></option> 
                      <?php endwhile; ?>
                </select>
              </div>
              <div class="form-group col-md-2" style="padding-left:30px">
                <label>Qty.</label>
                <input type="number" name="quantity" id="quantity" required="required" class="form-control text-left" value="0"/>'
              </div>
              <div class="form-group col-md-2" style="padding-left:30px">
                <label>Price</label>
                <input type="number" name="price" id="price" required="required" class="form-control text-left" value="0.00" />'
              </div>
              <div class="form-group col-md-2">
                <br>
                <button class="btn btn-secondary btn-sm btn-block col-md-6 float-right" type="button" id="add_item_btn" onclick="add_item()"><span class="fa fa-plus"></span> Add Item </button>
              </div>
          </div>
          </form>
          <br>
            <?php 
               $row_num = 1;
            ?>
            <table id="items_delivered" class="table table-bordered table-striped" >
                <thead class="bg-primary">
                  <tr>
                    <th>Item Code</th>
                    <th>Item Description</th>
                    <th>Unit of Measure</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total Amount</th>
                    <th name="footer_total" id="footer_total">0</th>
                  </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary btn-sm save_delivery" style="padding-left:30px" type="button" id="save_delivery" ></span> Save </button>
            <button class="btn btn-secondary btn-sm" style="padding-left:30px" type="button" id="cancel_assign" onclick="window.location='suppliesmasterlist.php'">Cancel </button>
          </div>
        </div>
    </div>
</div>        
</main>

    
  <script type="text/javascript">
    $(document).ready(function(){
      $('#table').DataTable();
    });
  </script>
  <script type="text/javascript">
          
    function add_item(){
      var cr_number = document.getElementById("cr_number").value;
      var department = document.getElementById("department").value;
      var tran_date = document.getElementById("tran_date").value;
      var item_id = document.getElementById("item_id").value;
      var qty = document.getElementById("quantity").value;
      var price = document.getElementById("price").value;

        if (cr_number == ''){
          alert_toast("Control Number required");
          return;
        }
        if (department == ''){
          alert_toast("Department required");
          return;
        }
        
        if (tran_date == '0000-00-00' || tran_date == '' || tran_date == 'mm/dd/yyyy'){
          alert_toast("Issuance Date required");
          return;
        }
        if (item_id == ''){
          alert_toast("Please Select Item");
          return;
        }
        if (qty == "0" || price == "0.00"){
          alert_toast("Quantity and Amount should not be zero");
          return;
         
        }
       $.ajax({
         url:"getiteminfo2.php?id="+item_id+"&qty="+qty+"&price="+price,
         type: 'get',
         dataType: 'html',
         success:function(response){
            $('#items_delivered').append(response);
            $('#items_delivered').find('tr').each(function (i, el) {
             var prev = document.getElementById("footer_total").value;
             var total_amount = 0;
             var $tds = $(this).find('td');
             var amount = parseFloat($tds.eq(5).text());
 
//              $total_amount = $tamt+price;
    
             total_amount = parseFloat(prev)+amount;
 //            $('#footer_total').html(total_amount);
            $('#footer_total').html($tamt);
   

              //}
            
              //alert(total_amount);
              document.getElementById('po_number').disabled = true;
              document.getElementById('tran_date').disabled = true;
              document.getElementById('item_id').value = "";
              document.getElementById('quantity').value = "0";
              document.getElementById('price').value = "0.00";
              
            });   
 
         }
        });


    };

  
           

      $('#cancel_assign').click(function(){

        var btn = document.getElementById('myBtn');
        btn.addEventListener('click', function() {
         document.location.href = 'some/page';
          });
      });


      $('#save_delivery').click(function(){

        var cr_number = document.getElementById('cr_number').value;
        var tran_date = document.getElementById('tran_date').value;
//        var pid = preg_replace('/[^0-9]/', '', document.getElementById('department').value); 
        //var item_id = document.getElementById('item_id').value;
//        $dep = document.getElementById('department').value;

        console.log(cr_number);
        $('#items_delivered').find('tr').each(function (i, el) {
            var $tds = $(this).find('td');
            var item_id = String($tds.eq(0).text());
            var qty = parseFloat($tds.eq(3).text());
            var price = parseFloat($tds.eq(4).text());
              console.log(item_id);   
              if (item_id != 'Item Code' && item_id != '' )
              {
                            
                //start_load()
                $.ajax({
                    type: "POST",
                    url: "ajax.php?action=add_item_issuance",
                    data: {
                        cr_number:cr_number,
                        tran_date:tran_date, 
                        item_id:item_id,
                        qty:qty,
                        price:price
                    },
                    success: function(resp) {
                      if(resp == 1){
                         alert_toast("Issuance successfully saved","success");
                         setTimeout(function(){
                         //location.reload();
                         location.href="suppliesdelivery.php";
                         },1000)
                      }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        //alert_toast(error);
                        setTimeout(function(){
                              location.reload();
                               },1000)
                    }
                });
              }
        });
      });
</script>