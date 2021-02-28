<!--  Receitas -->
<section id="insideContent">
    <div class="alignContent"><h3 class="txtCenter">{Formulário de Contato}</h3>
        <div class="contactForm alignContent">
            <?php if(!empty($this->errors) && count($this->errors) > 0){ ?>
              <p>{FORM_ERRORS}</p>
              <ul class="errors">
                <?php foreach($this->errors as $erro){ ?>
                  <li><?php echo($erro); ?></li>
                <?php } ?>

              </ul>
            <?php } ?>
            <form name="pro-field-contact" action="" enctype="multipart/form-data" method="POST">
                <ul>
                  <?php if(empty($this->success)){ ?>
                    <li class="txtCenter">
                        <label for="selectarea" title="Selecione a área com a qual deseja falar: " class="lblSel">
                            <select id="selectarea" class="selectchange " name="area">
                                <option value="">{Selecione a área com a qual deseja falar}: </option>
                                <?php foreach($this->subjects as $key => $subject) { ?>
                                <option <?php $this->formValues($this->values, "area", "option", $key); ?> value="<?php echo($key); ?>"><?php echo($subject); ?></option>
                                <?php } ?>
                            </select>
                        </label>
                    </li>

                    <li>
                        <div class="label"><h3>{Informações Pessoais}</h3></div>
                        <div class="contactFields">
                            <div>
                                <input <?php $this->formValues($this->values, "name"); ?> type="text" name="name" placeholder="Nome: ">
                                <label class="lblSel" for="gender" title="{Sexo}: ">
                                    <select id="gender" class="selectchange" name="gender">
                                        <option  value="">{Sexo}: </option>
                                        <option <?php $this->formValues($this->values, "gender", "option", "feminino"); ?> value="feminino">{Female}</option>
                                        <option <?php $this->formValues($this->values, "gender", "option", "masculino"); ?> value="masculino">{Masculine}</option>
                                    </select>
                                </label>
                            </div>
                            <div>
                                <input type="text" <?php $this->formValues($this->values, "birth"); ?> name="birth" placeholder="{Birthday}: ">
                                <input type="text" <?php $this->formValues($this->values, "relationship"); ?> name="relationship" placeholder="{Estado Civil}: ">
                                <input type="text" <?php $this->formValues($this->values, "cpf"); ?> name="cpf" placeholder="{CPF}: ">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="label"><h3>{Dados de Contato}</h3></div>
                        <div class="contactFields">
                            <div>
                                <input type="text" <?php $this->formValues($this->values, "cellphone"); ?>  name="cellphone" placeholder="{Cellphone}: ">
                                <input type="text" <?php $this->formValues($this->values, "phone"); ?> name="phone" placeholder="{Fixo}: ">
                            </div>
                            <div>
                                <input type="email" <?php $this->formValues($this->values, "email"); ?> name="email" placeholder="E-mail: ">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="label"><h3>{Sua Localização}</h3></div>
                        <div class="contactFields">
                            <div>
                                <input type="text" name="zipcode" <?php $this->formValues($this->values, "zipcode"); ?> placeholder="{CEP}: ">
                                <input type="text" name="address" <?php $this->formValues($this->values, "address"); ?> placeholder="{Address}: ">
                            </div>
                            <div>
                                <input type="text" <?php $this->formValues($this->values, "number"); ?> name="number" placeholder="{Número}: ">
                                <input type="text" <?php $this->formValues($this->values, "additional"); ?> name="additional" placeholder="{Complemento}: ">
                                <input type="text" <?php $this->formValues($this->values, "address2"); ?> name="address2" placeholder="{Bairro}: ">
                            </div>
                            <div>
                                <input type="text" <?php $this->formValues($this->values, "country"); ?> name="country" placeholder="{País}: ">
                                <input type="text" <?php $this->formValues($this->values, "state"); ?> name="state" placeholder="{State}: ">
                                <input type="text" <?php $this->formValues($this->values, "city"); ?> name="city" placeholder="{City}: ">
                            </div>
                        </div>
                    </li>
                    <li>

                        <div class="label"><h3>{Mensagem}</h3></div>
                        <div class="contactFields">
                            <div>
                                <input type="text" name="subject" placeholder="{Assunto}: " <?php $this->formValues($this->values, "subject"); ?>>
                            </div>
                            <div>
                                <textarea name="message" placeholder="{Mensagem:} "><?php $this->formValues($this->values, "message", "textarea"); ?></textarea>
                            </div>
                            <div class="file">
                                <label class="lblSel" for="fileimage" title="{Procurar}..."><input type="file" id="fileimage" class="filechange" name="image" placeholder="{Procurar}..."></label>
                                <span>{TAM_INFO}.</span>
                            </div>
                            <div>
                                <div class="captchaBox">
                                  <div class="g-recaptcha" data-sitekey="6LeuvyUTAAAAAHypU_0MnFL4YuR3PqNLMaa9l4SZ"></div>
                                </div>
                                <input type="submit" value="{Submit}">
                            </div>
                        </div>
                    </li>
                    <?php } else { ?>
                      <p class="txtCenter">{Mensagem enviada com sucesso}</p>
                    <?php } ?>
                </ul>

            </form>
        </div>

    </div>
</section>
<style>
  .captchaBox { border: 0; height:auto; }
</style>
