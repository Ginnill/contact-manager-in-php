<?php
session_start();

if ($_SESSION['email'] ?? null) :
    header("location:./dashboard");
endif;

include "./controller/login.php";
?>
<section class="login">
    <div class="container">
        <div class="register text-center">
            <p class="text">Não tem cadastro? <a href="/teste-fortunato/register" class="fw-bold">Criar Conta</a></p>
        </div>
        <div class="box-light form-container mx-auto col-12 col-md-8 col-lg-6 d-flex flex-column align-center justify-content-center">
            <div class="form-header text-center mb-2">
                <h2 class="sub-title">Login</h2>
                <p class="text">Faça login para acessar a agenda de contatos</p>
            </div>

            <?php if (isset($message)) : ?>
                <p class="text-danger"><?= $message ?></p>
            <?php endif; ?>
            <form class="row g-3 col-12" method="post">
                <div class="col-12">
                    <input class="col-12 input-text" type="email" name="email" id="email" placeholder="Digite o seu Email">
                </div>
                <div class="col-12">
                    <input class="col-12 input-text" type="password" name="pwd" id="pwd" placeholder="Senha">
                </div>

                <div class="form-footer col-12 mt-4">
                    <input class="button" name="login" id="login" type="submit" value="Entrar">
                </div>
            </form>
        </div>
    </div>
</section>