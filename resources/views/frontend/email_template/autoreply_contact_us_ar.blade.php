@include('frontend.email_template.layouts.header_ar_email')
		
		<tr>
			<td align="center" valign="top" id="templateBody" data-template-container>
			<!--[if gte mso 9]>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
			<tr>
			<td align="center" valign="top" width="600" style="width:600px;">
			<![endif]-->
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
					<tr>
						<td valign="top" class="bodyContainer">
							
						
							<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
								<tbody class="mcnTextBlockOuter">
									<tr>
										<td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
										<!--[if mso]>
										<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
										<tr>
										<![endif]-->

										<!--[if mso]>
										<td valign="top" width="600" style="width:600px;">
										<![endif]-->
											<table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
												<tbody>
													<tr>
														<td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">

															<p  style="text-align: center;">
																<span style="font-family:tahoma,verdana,segoe,sans-serif">
																	<span style="font-size:17px;text-align:right;"> 
																		<h3 style="text-align: right;"><span style="direction:rtl; display:inline-block;">عزيزي/عزيزتي {{ $contact_name }}،</span></h3>
																		<p style="text-align: right;direction:rtl">شكراً لتواصلكم معنا، سيتم الرد عليكم قريباً.</p>
																		
																	</span>
																</span>
															</p>

														</td>
													</tr>
												</tbody>
											</table>
										<!--[if mso]>
										</td>
										<![endif]-->

										<!--[if mso]>
										</tr>
										</table>
										<![endif]-->
										</td>
									</tr>
								</tbody>
							</table>
						
						</td>
					</tr>
				</table>
			<!--[if gte mso 9]>
			</td>
			</tr>
			</table>
			<![endif]-->
			</td>
		</tr>
		@include('frontend.email_template.layouts.footer_email')