<!-- include the header. -->
<?php require 'view/header.html'; ?>
    <!--
    <p>Here's a simple form to show PHP in action:</p>
        <!-- divide this column into 3/4 again to decrease size of form fields (just on large or medium size viewports) -->
        <div class="col-md-9 col-lg-9" >
            <form action="display_names.php" method="post">
                <fieldset class="nameFields">
                    <legend class="formLegend">Name Form</legend>
                    <div class="form-group">
                        <label for "firstName">Firsnihjkinjknjit Name:</label>
                        <!-- do some client-side validation of form data -->
                        <input pattern="^[A-Z][a-z]+$" title="Must start with a capital letter followed by one or more small letters" type="text" required class="form-control" name="first_name" placeholder="Enter in your first name">
                    </div>
                    <div class="form-group">
                        <label for "lastName">Last Name:</label>
                        <!-- do some client-side validation of form data -->
                        <input pattern="^[A-Z]'?[- a-zA-Z]+$" title="Must start with a capital letter, with an optional ',  followed by one or more dashes, small letters, or spaces" type="text" required class="form-control" name="last_name" placeholder="Enter in your last name">
                    </div>
                    <p><button type="submit" class="btn btn-primary" id="submitButton">Submit</button></p>
                </fieldset>
             </form>
        </div>
    <!-- include the footer. -->
<?php require 'view/footer.php'; ?>