<main>
        <h2 class="text-center mt-5">Create a new post</h2>
        <form class="mt-4 " action="process.php" method="post"  >
            <div class="container d-flex justify-content-center ">
                <div class="row col-md-8 col-10">

                    <div class="my-2">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" aria-label="First name"
                            required>
                    </div>

                    <div class="my-2">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" aria-label="Last name" required>
                    </div>


                    <div class="my-2">
                        <input type="text" class="form-control" name="post_title" id="post_title" placeholder="Post Title" aria-label="Post Title"
                            required>
                    </div>


                    <div class="my-2">
                        <input type="date"  class="form-control" name="post_date" id="post_date" required>
                    </div>
                    <div class="my-2">
                        <input type="text" class="form-control" name="book_name" id="book_name"  placeholder="Book Name" aria-label="Book Name" required>
                    </div>


                    <fieldset class="form-group">



                        <div class="my-2">
                            <label for="inputState" class="form-label col-md-2 col-10">Category</label>
                            <div class="col-sm-10">
                                <div class="form-check" required>
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                        value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Fiction
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input"  type="radio" name="gridRadios" id="gridRadios2"
                                        value="Fantasy">
                                    <label class="form-check-label" for="gridRadios2">
                                        Fantasy
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input"  type="radio" name="gridRadios" id="gridRadios3"
                                        value="Thriller">
                                    <label class="form-check-label"  for="gridRadios3">
                                        Thriller
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input"    type="radio" name="gridRadios" id="gridRadios4"
                                        value="Romance">
                                    <label class="form-check-label" for="gridRadios4">
                                        Romance
                                    </label>
                                </div>
                            </div>
                        </div>


                    </fieldset>

                    <div class="my-2 ">
                        <div class="">
                            <label for="stars" class="form-label">Stars</label>
                            <select id="stars" name="stars" required class="form-select">
                                <option value="" selected>Choose...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>

                    <div class="my-2">
                        <label for="review" class="form-label">Review</label>
                        <textarea class="form-control" name="review" id="review" rows="3"></textarea>
                    </div>

                    <div class="text-center mt-3 mb-2">
                        <button type="submit" class="btn btn-primary buttonForm ">Submit</button>
                    </div>
                </div>
            </div>
        </form>

         <h2 class="text-center mt-5 pb-3">Posts</h2>
         <?php  
        require __DIR__ . "/post.php";

         ?>
         
         
    </main>