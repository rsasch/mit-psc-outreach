$(document).ready(function(){
	$(".validate form input[type='submit']").attr("disabled", "");

	// open up links with rel="external" in  new window
	$("a").click(function(event){
		if ($(this).attr("rel") == "external") {
			// window features
			var status = "1";
			var toolbar = "1";
			var location = "1";
			var menubar = "1";
			var directories = "0";
			var resizable = "1";
			var scrollbars = "1";	
			var features = "status=" + status + ",toolbar=" + toolbar + ",location=" + location + ",menubar=" + menubar + ",directories=" + directories + ",resizable=" + resizable + ",scrollbars=" + scrollbars;
			var newWin = window.open(this, "newWin", features);
		
			newWin.focus();	
			return false;
		}
	});

	// show characters left for pertinent textarea fields
	$("textarea").keydown(function() {
		$id = $(this).attr('id');

		if ($("p#" + $id + "_notify").length != 0) {
			$maxlength = parseInt($("span#" + $id + "_maxlength").html());
			if (!isNaN($maxlength)) {
				if ($(this).val().length > $maxlength) {
					alert("You have exceeded the allowed character limit for this field. Please edit your content to a maximum of " + $maxlength + " characters.")
					$(this).val($(this).val().substring(0, $maxlength));
				}
				$left =  $maxlength - $(this).val().length;
				$("p#" + $id + "_notify").html($left + " characters left, max is " + $maxlength);
			}
		}
	});

	// form validation
	$(".validate form").submit(function() {
		$(".validate form input[type='submit']").attr("disabled", "disabled");

		// if there are file input fields but no files selected, remove enctype attribute from form to avoid weird behavior in Mac FF > v3.5
		if ($(this).attr("enctype")) {
			var test = "";
			$("input[type='file']").each(function() {
				 test += this.value;
			});
			if (test == "") {
				$(this).removeAttr("enctype");
			}
		}

		// if there are prompt fields, empty them by focusing on them before submit
		$(this).children("fieldset.category").children("div").children("input.prompt").focus();

		var mesg = "";
	
		// check that values for required fields are not empty
		$(this).children("fieldset").children(".required").children("input").each(function() {
			if(this.value == "") {
				mesg += $(this).siblings("label").html();
				mesg += " is required.\n";
			}
		});
		$(this).children("fieldset").children(".required").children("select").each(function() {
			if(this.value == "") {
				mesg += $(this).siblings("label").html();
				mesg += " is required.\n";
			}
		});
		$(this).children("fieldset").children(".required").children("textarea").each(function() {
			if(this.value == "") {
				$(this).siblings("label").children("span").remove();
				mesg += $(this).siblings("label").html();
				mesg += " is required.\n";
			}
		});

		// if in program add/edit form, check contacts
		if ($("input#public_contact1_email").length) {
			// The 2 public contact email addresses must not match each other
			if ($("input#public_contact1_email").val() == $("input#public_contact2_email").val()) {
				mesg += "The two public contact email addresses must not match each other.\n";
			}
	
			// There must be two distinct MIT email addresses for administrative contacts,
			// and they must contain .mit.edu.
			if ($("input#admin_contact1_email").val() == $("input#admin_contact2_email").val()) {
				mesg += "There must be two distinct MIT email addresses for administrative contacts.\n";
			}
			if ($("input#admin_contact1_email").val().toLowerCase().indexOf("mit.edu") < 0) {
				mesg += "Primary administrative contact email must be an MIT address.\n";
			}
			if ($("input#admin_contact2_email").val() && $("input#admin_contact2_email").val().toLowerCase().indexOf("mit.edu") < 0) {
				mesg += "Secondary administrative contact email must be an MIT address.\n";
				mesg += "\n";
			}
		}
		
		// At least one item must be selected from each Category
		var checkboxes = new Array();
		$(".category fieldset").each(function() {
			var tempArray = new Array();
			$(this).children("div.container").children("input[name='terms[]']").each(function() {
				if (this.checked) {
					tempArray.push(this.value);
				}
			});
			if (!tempArray.length) {
				$(this).siblings("h3").remove("span.aside");
				$(this).siblings("h3").children("span").remove();
				mesg += "There must be at least one criteria from the '";
				mesg += $(this).siblings("h3").html().toLowerCase();
				mesg += "' category checked.\n";
			}

		});
		
		$(".validate form input[type='submit']").attr("disabled", "");
		if (mesg) {
			// remove hidden field with submitted button value
			$(".validate form input.new").remove();
			alert(mesg);
			return false;
		}
		else {
			return true;
		}
	});
	
	$(".validate form input[type='submit']").click(function() {
		// add in hidden field with submitted button value
		$(this).form.append('<input type="hidden" class="hidden new" value="' + this.value + '" name="'+ this.name + '" />');
	});
	
	// add in hidden field so that PHP can confirm that javascript is running
	$("body.admin form").append('<input type="hidden" value="on" name="javascript" class="hidden" />');
	$("body.preview form").append('<input type="hidden" value="on" name="javascript" class="hidden" />');
	
	// add in disappearing text to search and criterion input fields
	$("input.prompt").each(function() {
		value = "";
		if ($(this).val() == "" || $(this).val() == "Search Terms" || $(this).val() == "New criterion") { 
			if (this.name == "term_name") {
				value = "New criterion";
			}
			else if (this.name == "keywords") {
				value = "Search Terms";
			}
			$(this).val(value);
		}
		else {
			$(this).removeClass("prompt");
		}
	});

	// remove disappearing text once the user focusing on it
	$("input.prompt").focus(function() {
		$(this).val("");
		$(this).removeClass("prompt");
	});
	
	// remove disappearing text before search form is submitted 
	$("body.results form").submit(function() {
		if (this.keywords.value == "Search Terms") {
			this.keywords.focus();
		}
	});
	$("body.home form").submit(function() {
		if (this.keywords.value == "Search Terms") {
			this.keywords.focus();
		}
	});
	
	// behavior for clear image buttons
	$("input[value='Clear']").click(function() {
		if(this.name.indexOf("clear_") == 0) {
			var newname = "empty_" + this.name.substring(6);
			$("input[name=" + newname + "]").val("1");
			$("input[name='" + this.name.substring(6)+ "']").val("");
			$("#" + this.name.substring(6) + "_path").attr('src', '');
		}

	});
	
	// behavior for clone checkboxes
	$("div.clone input[type='checkbox']").click(function() {
		var fields = new Array("name","org","address","phone","email");
		var prefix = this.value.match(/[a-z]+/);
		var num = this.value.match(/\d+/);
		if(this.checked) {
			for (var i in fields) {
				$("#" + prefix + "_contact" + num + "_" + fields[i]).val($("#public_contact1_" + fields[i]).val());
			}
		}
		else {
			for (var i in fields) {
				$("#" + prefix + "_contact" + num + "_" + fields[i]).val("");
			}
		}
	});
	
	// behavior for login button
	// <input type="button" value="login" name="login" />
	$("input[name='login']").click(function() {
		window.location = "/mit-psc-outreach/index.php/admin";
	});
	
	// behavior for request an account button
	// <input type="button" value="request an account" name="request" />
	$("input[name='request']").click(function() {
		window.location = "/mit-psc-outreach/index.php/login/add";
	});
	

});

