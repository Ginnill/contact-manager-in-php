<?php include "./controller/register.php"; ?>

<section class="register box-light">
    <div class="container">
        <div class="register text-center">
            <p class="text" style="color: #f8f8f8">Já possui uma conta? <a href="/teste-fortunato/" class="fw-bold">Entrar</a></p>
        </div>
        <div class="form-container mx-auto col-12 col-md-8 col-lg-6 d-flex flex-column align-center justify-content-center">
            <div class="form-header text-center mb-2">
                <h2 class="sub-title">Cadastro</h2>
                <p class="text">Faça um cadastro para poder usar o nosso sistema</p>
            </div>

            <?php if (isset($message)) : ?>
                <p class="text-danger"><?= $message ?></p>
            <?php endif; ?>

            <form class="row g-3 col-12" action="" method="post">
                <div class="col-12">
                    <input class="col-12 input-text" type="text" name="name" id="name" placeholder="Digite o seu nome" required>
                </div>
                <div class="col-12">
                    <input class="col-12 input-text" type="email" name="email" id="email" placeholder="Digite o seu Email" required>
                </div>
                <div class="col-12">
                    <input class="col-12 input-text" type="password" name="pwd" id="pwd" placeholder="Senha" minlength="8" required>
                </div>
                <div class="col-12">
                    <input class="col-12 input-text" type="password" name="pwd2" id="pwd2" placeholder="Confirme sua Senha" minlength="8" required>
                </div>
                <div class="form-footer col-12 mt-4">
                    <input class="button" name="register" id="register" type="submit" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>
</section>