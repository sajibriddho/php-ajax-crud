<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <section class="php__ajax__crud p-5">
    <div class="row">
      <div class="col-sm-4 px-3">
        <div class="add__form shadow bg-white px-4 py-5">
          <h3>Add Member Information</h3>
          <hr>
          <form>
            <div class="form-group">
              <label for="fullName">Full Name</label>
              <input type="text" class="form-control" id="fullName">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="contact">Contact Number</label>
              <input type="text" class="form-control" id="contact">
            </div>
            <div class="form-group">
              <label for="occupation">Occupation</label>
              <input type="text" class="form-control" id="occupation">
            </div>
            <button type="button" class="btn btn-primary" id="submit">Sign in</button>
          </form>
        </div>
      </div>
      <div class="col-sm-8 px-3">
        <div class="info__table">
          <table class="table table-hover border border-dark">
            <thead class="bg-dark text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact</th>
                <th scope="col">Occupation</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="bg-light" id="getMemberData">
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Modal form for edit  -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" id="updateFullName">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="updateEmail">
              </div>
              <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" class="form-control" id="updateContact">
              </div>
              <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" class="form-control" id="updateOccupation">
              </div>
              <input type="hidden" class="form-control" id="memberId">
            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="updateMemberInfo" type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal form for edit  -->
  </section>

  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/sweet-alert.js"></script>
  <script>
    $(document).ready(function() {
      showData();

      //Submit Data
      $("#submit").click(function() {
        var name = $("#fullName").val();
        var email = $("#email").val();
        var contact = $("#contact").val();
        var occupation = $("#occupation").val();

        $.ajax({
          type: 'post',
          url: './insertData.php',
          data: {
            name: name,
            email: email,
            contact: contact,
            occupation: occupation
          },
          success: function(response) {
            Swal.fire({
              icon: 'success',
              title: 'Added',
              showConfirmButton: false,
              timer: 1000
            });

            showData();
            //Make input field empty after submit
            $('#fullName').val("");
            $('#email').val("");
            $('#contact').val("");
            $('#occupation').val("");
          }
        });
      });

      //Show Member
      function showData() {
        $.ajax({
          type: 'post',
          url: './getData.php',
          data: {},
          success: function(response) {
            $("#getMemberData").html(response);

            // Edit member
            $(".editMember").click(function() {
              var memberId = $(this).data('id');
              var memberName = $(this).data('name');
              var memberEmail = $(this).data('email');
              var memberContact = $(this).data('contact');
              var memberOccupation = $(this).data('occupation');

              // Show edit data in modal form input  
              $("#memberId").val(memberId);
              $("#updateFullName").val(memberName);
              $("#updateEmail").val(memberEmail);
              $("#updateContact").val(memberContact);
              $("#updateOccupation").val(memberOccupation);

              //Update data 
              $("#updateMemberInfo").click(function() {
                var memberId = $("#memberId").val();
                var name = $("#updateFullName").val();
                var email = $("#updateEmail").val();
                var contact = $("#updateContact").val();
                var occupation = $("#updateOccupation").val();
                $.ajax({
                  type: 'post',
                  url: './update.php',
                  data: {
                    memberId: memberId,
                    name: name,
                    email: email,
                    contact: contact,
                    occupation: occupation,
                  },
                  success: function(response) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Updated',
                      showConfirmButton: false,
                      timer: 1000
                    });
                    showData();
                  }
                });
              })
            });

            //Delete member
            $(".deleteMember").click(function() {
              var memberId = $(this).data('id');
              $.ajax({
                type: 'post',
                url: './delete.php',
                data: {
                  memberId: memberId
                },
                success: function(response) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Deleted',
                    showConfirmButton: false,
                    timer: 1000
                  });
                  showData();
                }
              });
            });
          }
        });
      };
    })
  </script>
</body>

</html>