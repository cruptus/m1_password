<h1>Mot de passe</h1>
<form action="/password" method="post">
    <div class="form-group">
        <label for="lastname">Nom</label>
        <input type="text" class="form-control" id="lastname" name="lastname">
    </div>
    <hr />
    <div class="form-group">
        <label for="firstname">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname">
    </div>
    <hr />
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <hr />
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <div class="input-group">
            <input type="password" class="form-control" id="password" name="password">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button" id="passwordButton" style="padding: 9px">
                    <i class="glyphicon glyphicon-eye-close"></i>
                </button>
            </span>
        </div>
        <div class="progress" style="height: 5px; box-shadow: none; -webkit-box-shadow: none">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>
        <p class="help-block">Au moins 1 chiffre, 1 Majuscule, 1 ponctuation et 12 caractères</p>
    </div>
    <p style="color: #286090;"><b>Ou générer un mot de passe</b></p>

        <div class="form-group">
            <label for="passgenerator">Ecrire une phrase</label>
            <div class="input-group">
                <input type="text" class="form-control" id="passgenerator" name="password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" id="generator" type="button" style="padding: 9px">
                        <i class="glyphicon glyphicon-refresh"></i>
                    </button>
                </span>
            </div>
        </div>
    <hr />
    <button class="btn btn-primary">Inscription</button>
</form>

<script>
    $(document).ready(function () {
    	$('#passwordButton').click(function (e) {
    		$(this).children().toggleClass('glyphicon-eye-close glyphicon-eye-open')
            if ($(this).children().hasClass('glyphicon-eye-close')) {
    			$('#password').attr('type', 'password');
            } else {
	            $('#password').attr('type', 'text');
            }
        });

    	$('#generator').click(function (e) {
            var phrase = $('#passgenerator').val().split(" ");
            var password = "";
            if (phrase.length > 1) {
	            for (i = 0; i < phrase.length; i++) {
		            var random = Math.floor(Math.random() * 3) + 1;
		            switch (random) {
			            case 1 :
			            	if (phrase[i].split('').length > 1) {
								password += phrase[i].split('')[0].toUpperCase();
                            } else {
			            		password += phrase[i].toUpperCase();
                            }
				            break;
			            case 2 :
                            if (phrase[i].split('').length > 1) {
	                            password += phrase[i].split('')[0].toLowerCase();
                            } else {
                                password += phrase[i].toLowerCase();
                            }
				            break;
                        default :
                        	var tableau = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.', '?', '!', ',', ';'];
                            password += tableau[Math.floor(Math.random() * tableau.length)];
	                        break;
		            }
	            }
	            $('#password').val(password).attr('type', 'text');
	            $('#passwordButton').children().removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
                $.fn.passwordVerify(password)
            }
        });

    	$.fn.passwordVerify = function (password) {
            var width = 0;

            // Contient une majuscule
            if (/[A-Z]/.test(password))
                width += 12.5;
            // Contient au moins 2 majuscule
            if (/[A-Z]{2,}/.test(password))
                width += 12.5;

            // Au moins une minuscule
            if (/[\.?!,;]/.test(password))
                width += 12.5;
            if (/[\.?!,;]{2,}/.test(password))
                width += 12.5;

            // Au moins un chiffre
            if (/[0-9]/.test(password))
                width += 12.5;
            if (/[0-9]{2,}/.test(password))
                width += 12.5;

            // La longueur
            if(password.length >= 12) {
                if (password.length == 12)
                    width += 12.5;
                if (password.length > 12)
                    width += 25;
            } else if (password.length > 0) {
                width += 5;
            }


            $('.progress-bar').removeClass("progress-bar-danger").removeClass("progress-bar-success").removeClass("progress-bar-warning");

            if(width < 50)
                $('.progress-bar').addClass("progress-bar-danger");
            if(width < 75)
                $('.progress-bar').addClass("progress-bar-warning");
            if(width >= 75)
                $('.progress-bar').addClass("progress-bar-success");

            $('.progress-bar').css('width', width+'%');
        };


    	$('#password').keyup(function () {
    		$.fn.passwordVerify($(this).val());
        });


    });
</script>