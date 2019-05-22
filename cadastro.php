<?php include_once "header.php"; ?>

    <?php include_once "leftCol.php"; ?>

        <!-- Middle Column -->
        <div class="w3-col m9">

            <div class="col-lg-12">
                <h1 style="text-align:center;" class="mb-3">Edit Profile</h1>
                <hr>
                <form>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="img" placeholder="Picture URL" required>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="text-align:center;">
                        <div class="col-12">
                            <input type="submit" class="btn btn-dark" value="Save">
                        </div>
                    </div>
                    <hr>
                </form>

            </div>

            <!-- End Middle Column -->
        </div>

        <!-- End Grid -->
        </div>

        <!-- End Page Container -->
        </div>
        <br>

        <?php include_once "footer.php"; ?>

            <script>
                // Accordion
                function myFunction(id) {
                    var x = document.getElementById(id);
                    if (x.className.indexOf("w3-show") == -1) {
                        x.className += " w3-show";
                        x.previousElementSibling.className += " w3-theme-d1";
                    } else {
                        x.className = x.className.replace("w3-show", "");
                        x.previousElementSibling.className =
                            x.previousElementSibling.className.replace(" w3-theme-d1", "");
                    }
                }

                // Used to toggle the menu on smaller screens when clicking on the menu button
                function openNav() {
                    var x = document.getElementById("navDemo");
                    if (x.className.indexOf("w3-show") == -1) {
                        x.className += " w3-show";
                    } else {
                        x.className = x.className.replace(" w3-show", "");
                    }
                }
            </script>

            </body>

            </html>