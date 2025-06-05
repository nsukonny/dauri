<?php
//TODO Finish this. Ask at the fisrt.
?>
<div id="article-modal" class="modal-wrapper big">
    <div class="modal">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close" alt="Close button">
                <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/close.svg" alt="">
            </button>
            <h2>
                ПРЕДЛОЖИТЕ ТЕМУ <span>ДЛЯ СТАТЬИ</span>
            </h2>
            <p class="i">
                Какой темой Вы хотите поделиться с участниками клуба?
            </p>
            <form>
                <fieldset>
                    <div class="input-wrapper">
                        <label for="subject">
                            ТЕМА
                        </label>
                        <input id="subject" type="text" placeholder="Введите тематику своей новости">
                    </div>
                    <div class="input-wrapper">
                        <label for="info">
                            ИНФОРМАЦИЯ
                        </label>
                        <input id="info" type="text"
                               placeholder="Введите основную информацию, которой Вы обладаете по этой теме">
                    </div>
                </fieldset>
                <button class="button gradient big">ПРЕДЛОЖИТЬ</button>
            </form>
        </div>
    </div>

</div>