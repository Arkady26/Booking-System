function cvalidate(formname,errordiv)
{	
		var err_div='';
		if(errordiv!='')
		{
			err_div=errordiv;
		}
		else
		{
			err_div='lbl_error';
		}
		document.getElementById(err_div).innerHtml='';
		document.getElementById(err_div).style.display='none';

		var message='';
		var flagloop=false;		
		
		var f = document.forms[formname].elements;
		
		for (var i = 0; i < f.length; i++) {
			 var firstElement = f[i];
			 
			
			 var elementValue=firstElement.value;
				if (firstElement.hasAttributes()) 
    				{
							var attrs = firstElement.attributes;
      						var text = ""; 
							for(var j=attrs.length-1; j>=0; j--) {
											if(attrs[j].name == 'class'){
												var myString = attrs[j].value;
												var mySplitResult = myString.split(" ");
													for(l = 0; l < mySplitResult.length; l++){
															
														mystr=mySplitResult[l];
														if(mystr == 'val_req'){
															if(firstElement.value == ''){
																 
																message='Please Enter '+firstElement.title +' !';
																
																flagloop=true;													
																break;
															}else { 
															
															continue;
															}
														}
														else if(mystr == 'val_req_combo'){
															if(firstElement.value == '0'){
																message='Please Enter '+firstElement.title +' !';
																flagloop=true;													
																break;
															}else { 
															
															continue;
															}
														}
														else if(mystr == 'val_chk'){
															//alert('hhh');
															if(firstElement.checked == true){
																//alert('if');
																firstElement.value=1;
																flagloop=true;													
																break;
															}else { 
															
															continue;
															}
														}
														else if(mystr.substring(0,7) == 'val_len'){
															var longLast=mystr.substring(8,mystr.length);
															if(firstElement.value != '' && firstElement.value.length <= longLast){
															
															 message='Please Enter ' + firstElement.title + ' value atleast '+longLast + 'character !';
															 flagloop=true;
															 break;
															}else { continue;}
														}
														else if(mystr.substring(0,9) == 'val_r_len'){
															var longLast=mystr.substring(10,mystr.length);
															//alert(firstElement.value.length);
															if(firstElement.value != ''){																
																/*if(firstElement.value.length < longLast)
																{
																	 message='Please Enter ' + firstElement.title + ' value atleast '+longLast + ' character !';														 flagloop=true;
																	 break;
																}
																else*/
																 if(firstElement.value.length > longLast)
																{
																	
																	 message='Please Enter ' + firstElement.title + ' Less than or Equal to '+longLast + '  !';														 flagloop=true;
																	 break;
																}
															}
															else {
																 message='Please fill in '+firstElement.title +' !';
																 flagloop=true;
															 	break;
																}
														
															}
														else if(mystr.substring(0,11) == 'valn_r_len'){
															var longLast=mystr.substring(11,mystr.length);
															//alert(longLast);
															if(firstElement.value != ''){																
																if(firstElement.value.length > longLast)
																{
																	
																	 message='Please Enter ' + firstElement.title + ' Less than or Equal to '+longLast + '  !';														 flagloop=true;
																	 break;
																}
															}
															else {
																 message='Please fill in '+firstElement.title +' !';
																 flagloop=true;
															 	break;
																}
														
															}
														/*else if(mystr.substring(0,13) == 'val_r_len_min'){
															var longLast=mystr.substring(14,mystr.length);
															if(firstElement.value != '' && firstElement.value.length < longLast){
															 message='Sorry ! ' + firstElement.name + ' value must be more then  '+longLast;
															 flagloop=true;
															 break;
															}else {
																 message='Please fill in '+firstElement.name;
																 flagloop=true;
																 break;
																}
														
															}	*/
														else if(mystr == 'val_num'){
															 	if(isNaN(firstElement.value)){
																	message='Sorry ! ' + firstElement.title + ' value must be numeric !';
																	flagloop=true;
																	break;
																
																}																} 
														else if(mystr == 'val_r_num'){
																if(firstElement.value != ''){
																	if(isNaN(firstElement.value)){
																		message='Sorry ! ' + firstElement.title + ' value must be numeric !';
																		flagloop=true;
																		break;
																	}
																	else { continue;}
															}else { 
															   message='Please Enter valid '+firstElement.title +' !';
															   flagloop=true;
																break;
																} 
															}
															
														else if(mystr=='val_pass')	
														{
															if(document.getElementById('password').value!=document.getElementById('confirmpassword').value)
															{
																message='Password and Confirm Password does not match !';
																		flagloop=true;				
																			break;
															}
														}
														else if(mystr == 'val_email'){
															if(firstElement.value != ''){
															validmailregex =  /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        														if(validmailregex.test(firstElement.value) == false){ 
															message='Please Enter valid '+firstElement.title +' !';
																		flagloop=true;				
																			break;
																}
															}
														}
														else if(mystr == 'val_r_email'){
															
															
															if(firstElement.value != ''){
																//validmailregex =  /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
																var tmp=/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
																//if(validmailregex.test(firstElement.value) == false)
																if(firstElement.value.search(tmp)==-1)															
        														{
																message='Please Enter valid '+firstElement.title +' !';
																flagloop=true;	
																	break;
																}
															}
															else {
															message='Please  Enter '+firstElement.title +' !';
															flagloop=true;	
															break;
															}
															}
									
      								}
						if(flagloop==true)
						{
							break;
						}
    					
						}
						
								
				
				} 
					if(flagloop==true)
					{
						break;
					}
	
		}
		
		}
	if(message.length > 0)
	{
	document.getElementById(err_div).style.display='block';
	document.getElementById(err_div).innerHTML=message;
	scroll(0,0);
	return false;
	}
	return true;
}
