<main>
        <h2 class="text-center mt-5">Create a new post</h2>
        <form class="mt-4 " action="">
            <div class="container d-flex justify-content-center ">
                <div class="row col-md-8 col-10">

                    <div class="my-2">
                        <input type="text" class="form-control" placeholder="First name" aria-label="First name"
                            required>
                    </div>

                    <div class="my-2">
                        <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" required>
                    </div>


                    <div class="my-2">
                        <input type="text" class="form-control" placeholder="Post Title" aria-label="Post Title"
                            required>
                    </div>


                    <div class="my-2">
                        <input type="date" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <input type="text" class="form-control" placeholder="Book Name" aria-label="Book Name" required>
                    </div>


                    <fieldset class="form-group">



                        <div class="my-2">
                            <label for="inputState" class="form-label col-md-2 col-10">Category</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                        value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Fiction
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                        value="option2">
                                    <label class="form-check-label" for="gridRadios2">
                                        Fantasy
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3"
                                        value="option3">
                                    <label class="form-check-label" for="gridRadios3">
                                        Thriller
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4"
                                        value="option4">
                                    <label class="form-check-label" for="gridRadios4">
                                        Romance
                                    </label>
                                </div>
                            </div>
                        </div>


                    </fieldset>

                    <div class="my-2 ">
                        <div class="">
                            <label for="inputState" class="form-label">Stars</label>
                            <select id="inputState" required class="form-select">
                                <option selected>Choose...</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>

                    <div class="my-2">
                        <label for="review" class="form-label">Review</label>
                        <textarea class="form-control" id="review" rows="3"></textarea>
                    </div>

                    <div class="text-center mt-3 mb-5 ">
                        <button type="submit" class="btn btn-primary buttonForm ">Submit</button>
                    </div>
                </div>
            </div>
        </form>

        <?php
        include "post.php";
        ?>

    </main>