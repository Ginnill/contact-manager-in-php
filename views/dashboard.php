<?php
session_start();

if ($_SESSION['email'] == null) :
    header("location:./");
endif;

require "./controller/contact.php";
include "./controller/add-contact.php";
include "./controller/edit-contact.php";
include "./controller/delete-contact.php";


?>


<section class="dashboard box-light py-5">
    <div class="container">
        <div class="header d-flex justify-content-around">
            <h1>Dashboard</h1>
            <a href="/teste-fortunato/logout" class="exit text-danger fw-bold align-self-center">Sair →</a>
        </div>

        <div class="content-box">
            <div class="box-title">
                <h3 class="sub-title border">Contatos</h3>
            </div>

            <div class="contact-box row g-3 py-5 px-2 px-md-5 col-12 border mx-auto">
                <div class="add-card mb-5 mt-4">
                    <a href="" data-bs-toggle="modal" data-bs-target="#ContactModal">Adicionar Contato</a>
                </div>

                <?php foreach ($contacts as $contact) :  ?>
                    <div id="<?= str_replace(" ", "-", $contact['name']) ?>" class="card user border-0 col-md-6 col-lg-4">
                        <div class="border bg-white">
                            <!-- id -->
                            <div class="list-group d-none">
                                <input class="none" type="text" name="id_contact" id="id_contact" value="<?= $contact['id'] ?>">
                            </div>
                            <!-- id -->
                            <?php if ($contact['image'] != "") : ?>
                                <img width="280px" height="280px" src="<?= $contact['image'] ?>" class="card-img-top" alt="...">
                            <?php else : ?>
                                <img src="./img/img-avatar.png" class="card-img-top" alt="...">
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= $contact['name'] ?></h5>
                            </div>
                            <ul class="list-group list-group-flush border-top">
                                <li class="list-group-item email"><?= $contact['email']  ?></li>
                                <li class="list-group-item phone"><?= $contact['phone'] ?></li>
                            </ul>
                            <div class="card-body border-top d-flex flex-wrap justify-content-around">
                                <a href="#" class="card-link" data-bs-toggle="modal" data-bs-target="#EditContactModal">Editar</a>
                                <form action="" method="post">
                                    <input hidden type="text" name="delete-id" id="delete-id" value="<?= $contact['id'] ?>">
                                    <input type="submit" name="delete-btn" id="delete-btn" value="Excluir" class="card-link bg-none border-none text-danger">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<!-- modal -->

<div class="modal" id="ContactModal" tabindex="-1" aria-labelledby="ContactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ContactModalLabel">Adicionar Contato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group file border p-3">
                        <div class="title">
                            <p class="text">Imagem (280x280)</p>
                        </div>
                        <label class="col-12 d-none">Imagem</label>
                        <input class="form-control" type="file" name="add-file" id="file">
                    </div>

                    <div class="input-text-box border mt-5 px-3 py-4">
                        <div class="title">
                            <p class="text">Campo de Texto</p>
                        </div>
                        <div class="input-custom">
                            <label class="d-none">Nome</label>
                            <input class="input-text" name="add-name" id="add-name" type="text" placeholder="Digite o nome" require>
                        </div>

                        <div class="input-custom mt-3">
                            <label class="d-none">Email</label>
                            <input class="input-text" name="add-email" id="add-email" type="email" placeholder="Digite o email" require>
                        </div>

                        <div class="input-custom mt-3">
                            <label class="d-none">Phone</label>
                            <input class="input-text" data-js="input" size="20" maxlength="15" name="add-phone" id="add-phone" type="text" placeholder="Digite o Telefone" require>
                        </div>
                    </div>
                </div>
                <?php if (isset($add_message)) : ?>
                    <p class="text-danger px-3"><?= $add_message ?></p>
                <?php endif; ?>
                <?php if (isset($add_message_success)) : ?>
                    <p class="text-success px-3"><?= $add_message_success ?></p>
                <?php endif; ?>
                <div class="modal-footer">
                    <input type="submit" name="add-register" value="salvar" class="btn btn-primary">
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="EditContactModal" tabindex="-1" aria-labelledby="EditContactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditContactModalLabel">Editar Contato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="form-edit" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="input-group file border p-3 mt-3">
                        <div class="title">
                            <p class="text">Imagem (280x280)</p>
                        </div>
                        <label class="col-12 d-none">Imagem</label>
                        <input class="form-control" type="file" name="edit-file" id="edit-file">
                    </div>

                    <p class="text-center mt-5">Clique duas vezes no campo para editar</p>

                    <div class="input-text-box border mt-5 px-3 py-4">
                        <div class="title">
                            <p class="text">Campo de Texto</p>
                        </div>

                        <!-- id -->
                        <input name="edit-id" hidden id="edit-id" type="text">
                        <!-- id -->


                        <div class="input-custom">
                            <label class="d-none">Nome</label>
                            <input value="<?= $edit_result['name'] ?>" class="input-text" name="edit-name" id="edit-name" type="text" placeholder="Digite o nome" require>
                        </div>

                        <div class="input-custom mt-3">
                            <label class="d-none">Email</label>
                            <input value="<?= $edit_result['email'] ?>" class="input-text" name="edit-email" id="edit-email" type="email" placeholder="Digite o email" require>
                        </div>

                        <div class="input-custom mt-3">
                            <label class="d-none">Phone</label>
                            <input value="<?= $edit_result['phone'] ?>" class="input-text" data-js="input" size="20" maxlength="15" name="edit-phone" id="edit-phone" type="text" placeholder="Digite o Telefone" require>
                        </div>
                    </div>
                </div>
                <?php if (isset($edit_message)) : ?>
                    <p class="text-danger px-3"><?= $edit_message ?></p>
                <?php endif; ?>
                <?php if (isset($edit_message_success)) : ?>
                    <p class="text-success px-3"><?= $edit_message_success ?></p>
                <?php endif; ?>
                <div class="modal-footer">
                    <input type="submit" name="edit-register" value="salvar" class="btn btn-primary">
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php if (isset($add_message) || isset($add_message_success)) : ?>
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            var myModal = new bootstrap.Modal(document.getElementById('ContactModal'))
            myModal.show()
        })
    </script>
<?php endif; ?>

<?php if (isset($edit_message) || isset($edit_message_success)) : ?>
    <script defer>
        document.addEventListener("DOMContentLoaded", () => {
            var editMyModal = new bootstrap.Modal(document.getElementById('EditContactModal'))
            editMyModal.show()
        })
    </script>
<?php endif; ?>

<!-- mask -->
<script defer>
    const $input = document.querySelector('[data-js="input"]')
    $input.addEventListener('input', handleInput, false)

    function handleInput(e) {
        e.target.value = phoneMask(e.target.value)
    }

    function phoneMask(phone) {
        return phone.replace(/\D/g, '')
            .replace(/^(\d)/, '($1')
            .replace(/^(\(\d{2})(\d)/, '$1) $2')
            .replace(/(\d{4})(\d{1,5})/, '$1-$2')
            .replace(/(-\d{5})\d+?$/, '$1');
    }
</script>

<!-- Edit -->

<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        let editModal = document.querySelector("#EditContactModal")
        let contacts = document.querySelectorAll('.contact-box .user')

        document.onclick = el => {

            if (el.target.offsetParent.classList.contains('user')) {
                setTimeout(() => {
                    if (editModal.id = "EditContactModal") {
                        editModal.querySelectorAll(".input-text").forEach(input => {

                            // set disabled in all the input 
                            input.setAttribute("readonly", "readonly")
                            input.setAttribute("title", "Clique duas vezes para editar")

                            // remove disable to edit with double click
                            input.offsetParent.ondblclick = e => {
                                if (e.target.classList.contains('input-text')) {
                                    e.target.removeAttribute("readonly")
                                    e.target.removeAttribute("title")
                                    e.target.style.cursor = "inherit"
                                }
                            }

                            if (input.getAttribute("readonly") == "readonly") {
                                input.style.cursor = "pointer"
                            } else {
                                input.style.cursor = "inherit"
                            }

                            // set input fields with same value than contact card
                            let name = el.target.offsetParent.querySelector(".card-body .card-title").innerText
                            let email = el.target.offsetParent.querySelector(".list-group .email").innerText
                            let phone = el.target.offsetParent.querySelector(".list-group .phone").innerText
                            let id = el.target.offsetParent.querySelector(".list-group #id_contact").value

                            localStorage.setItem('c_id', id)

                            let input_id = editModal.querySelector('#edit-id')

                            input.id == 'edit-name' ? input.value = name : "";
                            input.id == 'edit-email' ? input.value = email : "";
                            input.id == 'edit-phone' ? input.value = phone : "";
                            input_id.id == 'edit-id' ? input_id.value = id : "";

                            input.id == 'edit-name' ? input.text = name : "";
                            input.id == 'edit-email' ? input.text = email : "";
                            input.id == 'edit-phone' ? input.text = phone : "";
                            input_id.id == 'edit-id' ? input_id.text = id : "";
                            // 
                        })
                    }
                }, 50);
            }
        }

        setTimeout(() => {
            location.hash = ""
            history.replaceState("", "", location.pathname)
        }, 50);
    })
</script>