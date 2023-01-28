<?php include("top.html"); ?>

<!-- Web Programming, Project 4 (NerdLuv)
     signup.php -->
<form action="signup-submit.php" method="POST">
    <fieldset>
    <legend>New User Signup:</legend>
        <p>
            <label class="left"><strong>Name:</strong></label> 
            <input type="text" name="name" /> 
        </p>
        <p>
            <label class="left"><strong>Gender:</strong></label> 
            <label><input type="radio" name="gender" value="M" />Male</label>
            <label><input type="radio" name="gender" value="F" />Female</label> 
        </p>
        <p>
            <label class="left"><strong>Age:</strong></label> 
            <input type="text" name="age" size="6" maxlength="2" />
        </p>
        <p>
            <label class="left"><strong>Personality type:</strong></label>
            <input type="text" name="personality" size="6" maxlength="4" /> 
            (<a href="https://www.humanmetrics.com/personality">Don't know your type?</a>)
        </p>
        <p>
            <label class="left"><strong>Favorite OS:</strong></label>
            <select name="favoriteOS">
                <option selected="selected" value="Windows">Windows</option>\
                <option value="Mac OS X">Mac OS X</option>
                <option value="Linux">Linux</option>
            </select> 
        </p>
        <p>
            <label class="left"><strong>Seeking age:</strong></label>
            <input type="text" name="agemin" placeholder="min" size="6" maxlength="2" /> to
            <input type="text" name="agemax" placeholder="max" size="6" maxlength="2" />
        </p>
        
        <p><input type="submit" value="Sign Up" /></p>
    </fieldset>
</form>

<?php include("bottom.html"); ?>