Another wordpress themes using sage as base template

## installation for test purpose
* copy themes to wordpress themes folder.
* run npm install > bower install > gulp.
* if on development process run gulp watch
* import data test from tools > import > wordpress
* open wp dashboard, edit themes
* open costumize menu
* add 2 menu set: header menu, footer menu
* at customize, set main header in menu option
* for footer can be added at widget part, add custom menu, add text for copyright
* set frontpage as static page

## adding share button support
* install [JETPACK](https://jetpack.me/) plugin
* activate shared buttons
* edit functions and css to change it position on post

## adding popular post support
* install plugin [WordPress Popular Posts](https://wordpress.org/plugins/wordpress-popular-posts/) on news single page

## allowing registration
* go to setting > tick membership > set new user default role
* add custom page for login
* add custom page for registration
* adding plugin: [WP User Avatar](https://wordpress.org/support/plugin/wp-user-avatar)

## contact-us page
* add [WP Contact Form 7](http://contactform7.com)
* create new contact form
* copy code bellow

```html
<div class="row">
<div class="form-group col-sm-5">
[email* email01 class:input-email class:form-control placeholder "Email"]
</div>
</div>

<div class="row">
<div class="form-group col-sm-3">
[text* username class:input-username class:form-control placeholder "Username"]
</div>
</div>

<div class="row">
<div class="form-group col-sm-3">
[select* category id:category class:category class:form-control "cat1" "cat2" "cat3" "cat4"]
</div>
</div>

<div class="row">
<div class="form-group col-sm-5">
[text* subject id:subject class:subject class:form-control placeholder "Subject"]
</div>
</div>

<div class="row">
<div class="form-group col-sm-7">
<p>[textarea* message id:message class:message class:form-control placeholder "Message"]</p>
</div>
</div>

<p><b>Attach File:</b></p>
<ul id="attachment">
<li>[file File-01]</li>
<li>[file File-02]</li>
<li>[file File-03]</li>
<li>[file File-04]</li>
<li>[file File-05]</li>
</ul>

<br>
<p><b>Security Code: </b></p>
[recaptcha id:recaptcha class:g-recaptcha size:normal]

<div class="container-fluid buttons">   
  <p>[submit class:btn class:btn-default id:submit"Send"] <a id="reset" class="btn btn-default" href="#">Reset</a></p>
</div>
```
--------
aDMIN:rahasia
