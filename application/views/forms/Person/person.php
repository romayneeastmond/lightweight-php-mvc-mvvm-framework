<form method="post">
    <div class="form-group">
        <label php-label-for="firstName"></label>
        <input php-input-for="firstName" php-value-for="firstName" class="form-control" />
    </div>
    <div class="form-group">
        <label php-label-for="lastName"></label>
        <input php-input-for="lastName" php-value-for="lastName" class="form-control" />
    </div>
    <div class="form-group">
        <label php-label-for="emailAddress"></label>
        <input php-input-for="emailAddress" php-value-for="emailAddress" class="form-control" />
    </div>
    <div class="form-group">
        <label php-label-for="description"></label>
        <textarea php-input-for="description" php-value-for="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label php-label-for="sex"></label>
        <div>
            <input php-input-for="sex" php-value-for="sex" />
        </div>
    </div>
    <div class="form-group">
        <label php-label-for="province"></label>
        <select php-input-for="province" php-value-for="province" class="form-control"></select>
    </div>
    <div class="form-group">
        <label php-label-for="languages"></label>
        <select php-input-for="languages" php-value-for="languages" class="form-control"></select>
    </div>
    <div>
        &nbsp;
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Submit</button>
    </div>
</form>