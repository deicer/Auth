div class="container">
    <h1 class="text-center">Форма обратной связи</h1>
    <form action="" class="form-horizontal" id="ajax_form">
        <div id="userName" class="form-group">
            <label for="name" class="control-label col-sm-2">Ваше имя*</label>
            <input name="name" id="name" type="text" placeholder="Егор" class="form-control field required"
                   data-validation="length"
                   data-validation-length="min3"
                   data-validation-error-msg="Проверьте ваше имя, не ужели оно такое короткое?">

        </div>
        <div id="userEmail" class="form-group">
            <label for="email" class="control-label col-sm-2">Ваша почта*</label>
            <input name="email" id="email" type="text" placeholder="a.pedro@gmail.com" class="form-control field required"
                   data-validation="required" data-validation-error-msg="Проверьте почту, она какая-то ни такая">
        </div>
        <div id="userText" class="form-group">
            <label for="text" class="control-label col-sm-2">Текст отзыва*</label>
            <textarea name="text" id="text" class="form-control field required" placeholder="Как я вообще сюда попал?"
                      data-validation="required"
                      data-validation-error-msg="По подробнее пожалуйста!"></textarea>
        </div>
        <div id="userAvatar" class="form-group">
            <label for="avatar" class="control-label col-sm-2">Ваша Аватарка</label>
            <input name="avatar" id="avatar" type="file" class="form-control-file field required">
        </div>
        <div class="form-group">
            <div class="controls">
                <button id="btn" type="button" class="btn">Отправить</button>
                <button type="reset" class="btn">Очистить</button>
            </div>
        </div>
        <div class="form-group">
            <div>* - поля обязательные для заполнения</div>
        </div>
    </form>
    <div id="result_form"></div>
</div>
