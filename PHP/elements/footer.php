</main><!-- /.container -->

<footer>
    <hr>

    <div class="row">
        <div class="col-md-4">
            <?php
            require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'DoubleCompteur.php';
            $compteur = new DoubleCompteur(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur');
            $compteur->incrementer();
            $vues = $compteur->recuperer();

            ?>
            Il y a <?= $vues ?> visite<?= $vues > 1 ? "s" : '' ?> sur le site ce jour
        </div>
        <div class="col-md-4">
            <form action="newsletter.php" method="POST" class="form-inline">
                <div class="form-group">
                    <label for="email">
                        <input class="form-control" name="email" type="email" placeholder="Entrer votre email" required>
                    </label>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">S'inscrire</button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <h5>Navigation</h5>
            <ul class="list-unstyled text-small">
                <?= nav_menu(''); ?>
            </ul>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>