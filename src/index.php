<?php include('header.php'); ?>
<div class="container mt-5">
    <form id="signo-form" method="POST" action="show_zodiac_sign.php" class="mb-4">
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Digite sua data de nascimento:</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Descobrir Signo</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
