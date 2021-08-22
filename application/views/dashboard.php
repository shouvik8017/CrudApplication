<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/css/bootstrap.min.css'; ?>"> 
  <link rel="stylesheet" href="<?= base_url().'assets/css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" href="<?= base_url().'assets/css/brands.css'; ?>">
  <link rel="stylesheet" href="<?= base_url().'assets/css/fontawesome.css'; ?>">
  <link rel="stylesheet" href="<?= base_url().'assets/css/solid.css'; ?>">

  <style type="text/css">
  .page-item a{
    position: relative;
    display: block;
    color: #0d6efd;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #dee2e6;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    padding: .375rem .75rem;
  }

  .page-item:first-child a {
    border-top-left-radius: .25rem;
    border-bottom-left-radius: .25rem;
  }
</style>

<title>Dashboard</title>
</head>
<body style="background-color: azure;">

  <?php 

  $login_details = $this->session->userdata('login_user');
  $fullname = $login_details['fullname'];

  ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">Assignment</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url().'Home_controller/dashboard'; ?>">Dashboard</a>
          </li>
        </ul>
        <span class="navbar-text">
          Welcome, <?= $fullname; ?>
        </span>&nbsp;&nbsp;
        <a href="<?= base_url().'logout'; ?>" class="btn btn-outline-danger">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container">


    <div class="row justify-content-center m-2 p-2">
      <div class="card col-4 p-2">
        <h1 style="text-align: center;">Product Details</h1>
      </div>

      <div class="clearfix"></div>

      <div class="card col-8 mt-5 p-2">
        <form method="POST" action="<?= base_url().'Home_controller/dashboard'; ?>">
          <div class="row g-3 align-items-center">
            <div class="col-auto">
              <input type="text" id="name" name="name" class="form-control" value="" placeholder="Please Enter Product Name" required>
            </div>
            <div class="col-auto">
              <input type="submit" class="btn btn-outline-success" name="search" id="search" value="Search">
            </div>
          </div>
        </form>
      </div>

      <div class="card col-8 mt-2 p-2">

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <div>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <div>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          </div>
        <?php endif; ?>

        <table class="table table-striped">

          <div class="col-md-12">
            <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#product_add">
              Add Products
            </button>
          </div>

          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i=0;
            if(isset($products) && !empty($products)):
              foreach($products as $product):
                $i++;
                ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>
                  <td><?= $product['name_200']; ?></td>
                  <td><?= $product['price_200']; ?></td>
                  <td><?= $product['description_200']; ?></td>
                  <td>
                    <a href="#" class="btn btn-outline-warning" title="Edit Product" data-bs-toggle="modal" data-bs-target="#product_update<?= $product['id_200']; ?>"><i class="fas fa-edit"></i></a>
                    <a href="<?= base_url().'delete/'.$product['id_200'];?>" class="btn btn-outline-danger" title="Delete Product"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
              <?php endforeach; endif; ?>
            </tbody>
          </table>

          <?php echo $this->pagination->create_links(); ?> 

        </div>
      </div>

      <?php
      $i=0;
      if(isset($products) && !empty($products)):
        foreach($products as $product):
          $i++;
          ?>

          <!-- Modal -->
          <div class="modal fade" id="product_update<?= $product['id_200']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Save Product Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="<?= base_url().'product-update/'.$product['id_200']; ?>" id="product-update" onsubmit="return valid(<?= $product['id_200']; ?>)">

                  <div class="modal-body">

                    <input type="hidden" name="id_200<?= $product['id_200']; ?>" id="id_200<?= $product['id_200']; ?>" value="<?= $product['id_200']; ?>">

                    <div class="mb-3">
                      <label for="product_name<?= $product['id_200']; ?>" class="form-label">Product Name</label>
                      <input type="text" class="form-control" name="product_name<?= $product['id_200']; ?>" id="product_name<?= $product['id_200']; ?>" value="<?= $product['name_200']; ?>" >
                      <span class="text-danger" id="product_name_error<?= $product['id_200']; ?>"></span>
                    </div>

                    <div class="mb-3">
                      <label for="product_price<?= $product['id_200']; ?>" class="form-label">Product Price</label>
                      <input type="text" class="form-control" onkeypress="return isNumber(event)" name="product_price<?= $product['id_200']; ?>" id="product_price<?= $product['id_200']; ?>" value="<?= $product['price_200']; ?>" required>
                      <span class="text-danger" id="product_price_error<?= $product['id_200']; ?>"></span>
                    </div>

                    <div class="mb-3">
                      <label for="product_description<?= $product['id_200']; ?>" class="form-label">Product Description</label>
                      <textarea class="form-control" name="product_description<?= $product['id_200']; ?>" id="product_description<?= $product['id_200']; ?>" required><?= $product['description_200']; ?></textarea>
                      <span class="text-danger" id="product_description_error<?= $product['id_200']; ?>"></span>
                    </div>

                    <input type="submit" name="update" id="update" class="btn btn-outline-success" value="Update">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>

                  </div>

                </form>

                <div class="modal-footer">
                </div>

              </div>
            </div>
          </div>

        <?php endforeach; endif; ?>

        <!-- Modal -->
        <div class="modal fade" id="product_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Save Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <form method="POST" action="<?= base_url().'product-save'; ?>" id="product-save">

                <div class="modal-body">

                  <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" value="" required>
                    <span class="text-danger" id="product_name_error"></span>
                  </div>

                  <div class="mb-3">
                    <label for="product_price" class="form-label">Product Price</label>
                    <input type="text" class="form-control" onkeypress="return isNumber(event)" name="product_price" id="product_price" value="" required>
                    <span class="text-danger" id="product_price_error"></span>
                  </div>

                  <div class="mb-3">
                    <label for="product_description" class="form-label">Product Description</label>
                    <textarea class="form-control" name="product_description" id="product_description" required></textarea>
                    <span class="text-danger" id="product_description_error"></span>
                  </div>

                  <input type="submit" name="save" id="save" class="btn btn-outline-success" value="Save">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>

                </div>

              </form>

              <div class="modal-footer">
              </div>

            </div>
          </div>
        </div>

      </div>

      <script src="<?= base_url().'assets/js/bootstrap.bundle.min.js'; ?>"></script> 
      <script src="<?= base_url().'assets/js/jquery.min.js'; ?>"></script> 
      <script defer src="<?= base_url().'assets/js/brands.js'; ?>"></script>
      <script defer src="<?= base_url().'assets/js/solid.js'; ?>"></script>
      <script defer src="<?= base_url().'assets/js/fontawesome.js'; ?>"></script>

      <script type="text/javascript">
        function isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
          }
          return true;
        }

        function validCheck(e) {
          var keyCode = (e.which) ? e.which : e.keyCode;
          if ((keyCode >= 48 && keyCode <= 57) || (keyCode == 8))
            return true;
          else if (keyCode == 46) {
            var curVal = document.activeElement.value;
            if (curVal != null && curVal.trim().indexOf('.') == -1)
              return true;
            else
              return false;
          }
          else
            return false;
        }

      </script>

      <script type="text/javascript">
        $(document).ready(function(){

          $("#product-save").on("submit", function(){

            var name = $("#product_name").val();
            var price = $("#product_price").val();
            var description = $("#product_description").val();

            var status = true;

            if (name == '') 
            {
              $("#product_name_error").text("This field is required");
              status = false;
            }
            else
            {
              $("#product_name_error").text("");
            }

            if (price == '') 
            {
              $("#product_price_error").text("This field is required");
              status = false;
            }
            else
            {
              $("#product_price_error").text("");
            }

            if (description == '') 
            {
              $("#product_description_error").text("This field is required");
              status = false;
            }
            else
            {
              $("#product_description_error").text("");
            }

            if (status) 
            {
              return true;
            }
            else
            {
              return false;
            }

          });

        });
      </script>

      <script type="text/javascript">

        function valid(id) 
        {

          var name = $("#product_name"+id).val();
          var price = $("#product_price"+id).val();
          var description = $("#product_description"+id).val();

          var status = true;

          if (name == '') 
          {
            $("#product_name_error"+id).text("This field is required");
            status = false;
          }
          else
          {
            $("#product_name_error"+id).text("");
          }

          if (price == '') 
          {
            $("#product_price_error"+id).text("This field is required");
            status = false;
          }
          else
          {
            $("#product_price_error"+id).text("");
          }

          if (description == '') 
          {
            $("#product_description_error"+id).text("This field is required");
            status = false;
          }
          else
          {
            $("#product_description_error"+id).text("");
          }

          if (status) 
          {
            return true;
          }
          else
          {
            return false;
          }

        }

      </script>

    </body>
    </html>