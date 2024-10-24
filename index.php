<?php
include './layout/header.php'
?>

<div class="container mx-auto">
    <form class="col-6 mx-auto" action="./login.php">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input
                type="text"
                class="form-control"
                name="username"
                id="username"
                aria-describedby="helpId"
                placeholder="Iserisci il tuo username" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="text"
                class="form-control"
                name="password"
                id="password"
                aria-describedby="helpId"
                placeholder="Iserisci la tua password" />
        </div>

        <button
            type="submit"
            class="btn btn-primary">
            Accedi
        </button>


    </form>
</div>

<?php include './layout/footer.php'; ?>