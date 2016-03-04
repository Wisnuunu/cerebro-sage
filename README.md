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


## <del>adding share button support
* <del>install [JETPACK](https://jetpack.me/) plugin</del>
* <del> activate shared buttons </del>
* <del> edit functions and css to change it position on post </del>
* ** jetpack plugin incompatible, and made add media and tags become unusable  **

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

## slideshow gallery
* adding [tribulant slideshow](https://wordpress.org/plugins/slideshow-gallery)
* add image to slideshow-gallery > create gallery
* paste the shortcode in post-edit
* the shortcode must between custom tag, eg: `[hide_gallery] [the_shortcode] [/hide_gallery]`. It will make the gallery dissapear from post. The image gallery will appear in featured image position.
* add custom fields in page edit post, with id: "gallery_id" and the value is gallery id that have been created

## editable carousel header
* can be used on each main page
* add slug divided by ``#`` symbol in page content editor. eg:
``#this-is-1st-slug
#this-is-2nd-slug``
* it will get title, excerpt, and featured image to be displayed on carousel section.

## running text feature
* add new custom field ``running_text`` in main homepage
* add the running text value

## share button
* add plugin [Shareaholic](https://wordpress.org/plugins/shareaholic/)
* un-check everything on Shareholic dashboard
* do user registration
* customize share button on post section
* set share button style, remove unused button, check share counter, check total share counter
* copy the shortcode > paste on ``format-news.php`` at ``shared-buttons`` section

## Event location
* add custom field ``event_location`` and its value on post page everytime event post category is created
* the main home page will add extra information for event location

## youtube playlist
* on post with video category, add custom field ``youtube_playlist``
* create a playlist on youtube if u have none, or get other youtube playlist.
* on youtube playlist page, press ``share`` > copy link address
* on video post, paste on custom field ``youtube_playlist``

## Beasiswa post
* added new layout if post category is ``Beasiswa``
* there were custom field in here: Details and Link Buttons, just add this section for template after the main articles
```html
<div class="details row" style="background-color: #cc1111; color: white; margin: 5px 10px;">
<div class="title" style="padding: 10px;"><b><u>Details</u></b></div>
<div class="col-md-6 left-side">
<ul style="list-style: none;">
  <li><b>Jenjang:</b><br>Pascasarjana</li>
  <li><b>Study Date:</b><br>September 2016</li>
  <li><b>Deadline Submit:</b><br>30 April 2016</li>
  <li><b>Beasiswa:</b><br>S$23.300.000 (Rp 23.961.542) per tahun</li>
</ul>
</div>
<div class="col-md-6 right-side">
<ul style="list-style: none;">
  <li><b>Phone:</b><br>+6200000000</li>
  <li><b>Email:</b><br>email@email.com</li>
  <li><b>Place:</b><br>Singapore University of Technology and Design <br> 20 Dover Drive, 1230912, Singapore</li>
  <li><b>Ambassador:</b><br>Jl. Kemerdekaan no.1 Jakarta Utara</li>
</ul>
</div>
</div>
```
* for link buttons, add custom field ``goto_url`` and ``download_url``, and insert the details there

--------
aDMIN:rahasia
