<?php require_once("db_connection.php"); ?>
<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Coustomer</title>
</head>
<body>
  <section class="hero is-fullheight is-dark is-bold">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-vcentered">
          <div class="column is-4 is-offset-4">
            <h1 class="title">
              Register the Customer
            </h1>
            <div class="box">
              <form accept-charset="UTF-8" action="submit_c_form.php" autocomplete="off" method="POST" target="_blank">
              	<div class="field">
              	  <label class="label">First Name</label>
              	  <div class="control">
              	    <input class="input" name="fn" type="text" placeholder="Text input" maxlength="20">
              	  </div>
              	</div>
              	<div class="field">
                  <label class="label">Middle Name</label>
                  <div class="control">
                    <input class="input" type="text" name="mn" placeholder="Text input" maxlength="1">
                </div>
              </div>
              <div class="field">
                <label class="label">Last Name</label>
                <div class="control">
                  <input class="input" type="text" name="ln" placeholder="Text input" maxlength="20">
                </div>
              </div>
              <div class="field">
                <label class="label">Email</label>
                <div class="control has-icons-left has-icons-right">
                  <input class="input is-info" type="email" name="em" placeholder="hello@someone.com">
                  <span class="icon is-small is-left">
                    <i class="fa fa-envelope"></i>
                  </span>
                  <span class="icon is-small is-right">
                    <i class="fa fa-check"></i>
                  </span>
                </div>
              </div>
              <div class="field">
              	<label class="label">Phone Number</label>
              	<div class="control">
              		<input class="input" type="integer" name="pn" placeholder="Text input" maxlength="10" size="10">
              	</div>
              </div>
              <div class="field">
                <label class="label">Address</label>
                <div class="control">
                  <textarea class="textarea" placeholder="Textarea" name="ms" maxlength="100"></textarea>
                </div>
              </div>
              <div class="field">
                <label class="label">City</label>
                <div class="control">
                  <input class="input" type="text" name="ci" placeholder="Text input" maxlength="10">
                </div>
              </div>
              <div class="field">
                <label class="label">Pincode</label>
                <div class="control">
                  <input class="input" type="integer" name="pi" placeholder="Text input" maxlength="6" size="6">
                </div>
              </div>
              <div class="field">
                <label class="label">Country</label>
                <div class="control">
                  <input class="input" type="text" name="co" placeholder="Text input" maxlength="10">
                </div>
              </div>
              <div class="field">
              <div class="control">
                <label class="radio">
                  <input type="radio" name="visa">
                  VISA
                </label>
                <label class="radio">
                  <input type="radio" name="Aadhar">
                  AADHAR
                </label>
                <div class="field">
                  <div class="control">
                    <input class="input" name="va" type="integer" placeholder="●●●●●●●●●●●●●●●●" maxlength="16">
                  </div>
                </div>
                <div class="field is-grouped is-grouped-centered">
                  <p class="control">
                    <button class="button is-primary" type="submit" name="submit" value="Create Customer" >
                      Submit
                    </button>
                  </p>
                  <p class="control">
                    <a class="button is-light">
                      Cancel
                    </a>
                  </p>
                </div>
              </div>
            </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
  </html>
