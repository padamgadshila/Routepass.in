<style>
    .alert {
        position: fixed;
        top: 20px;
        left: calc(100% - 60%);
        width: 350px;
        transform: scale(0);
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        background: rgb(83, 220, 83);
        transition: all .4s;
        z-index: 400;
    }

    .alert i {
        cursor: pointer;
        font-size: 15px;
        color: green;
    }

    .alert span {
        color: green;
    }

    @media (max-width:400px) {
        .alert {
            left: 20px;
        }
    }
</style>

<div class="alert">
    <span id="pop-msg"> <?php echo $_SESSION['success']; ?></span>
</div>

<script>
    let alertt = document.querySelector('.alert');
    let text = document.getElementById('pop-msg');
    <?php
    if (isset($_SESSION['success'])) {
    ?>
        setTimeout(() => {
            alertt.style.transform = 'scale(1)';
        }, 300);
        setTimeout(() => {
            text.innerText = 'Redirecting';
            alertt.style.boxShadow = "0 0 12px 10px lightgreen";
        }, 2300);
        setTimeout(() => {
            alertt.style.transform = 'scale(0)';
        }, 3500);
        setTimeout(() => {
            window.location = '<?php echo $_SESSION['push']; ?>';
        }, 4900);
    <?php
        unset($_SESSION['success']);
        unset($_SESSION['push']);
    }
    ?>
    close.addEventListener('click', () => {
        alertt.classList.remove('alert-pop');
    });
</script>