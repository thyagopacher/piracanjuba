<!--  Receitas -->
<section id="insideContent">
    <div class="alignContent"><h3 class="txtCenter">{Formulário de Contato}</h3>
        <?php if (empty($this->success)) { ?>
        <?= $this->textoTopo->DTQ_TXT ?>
        <?php } ?>
        <div class="contactForm alignContent">
            <?php if (!empty($this->errors) && count($this->errors) > 0) { ?>
                <p>{FORM_ERRORS}</p>
                <ul class="errors">
                    <?php foreach ($this->errors as $erro) { ?>
                        <li><?php echo($erro); ?></li>
                    <?php } ?>

                </ul>
            <?php } ?>
            <form name="pro-field-contact" action="" enctype="multipart/form-data" method="POST" id="formulario_contato">
                <ul>
                    <?php if (empty($this->success)) { ?>
                        <li class="txtCenter">
                            <label for="selectarea" title="Selecione a área com a qual deseja falar: " class="lblSel">
                                <select id="selectarea" class="selectchange " name="area">
                                    <option value="">* {Assunto}:</option>
                                    <?php foreach ($this->subjects as $key => $subject) { ?>
                                        <option <?php $this->formValues($this->values, "area", "option", $key); ?>
                                            value="<?php echo($key); ?>"><?php echo($subject); ?></option>
                                    <?php } ?>
                                </select>
                            </label>
                        </li>
                        <style>
                            select option {
                                text-transform: uppercase;
                            }

                            /* all */
                            ::-webkit-input-placeholder { text-transform:uppercase; }
                            ::-moz-placeholder { text-transform:uppercase; } /* firefox 19+ */
                            :-ms-input-placeholder { text-transform:uppercase; } /* ie */
                            input:-moz-placeholder { text-transform:uppercase; }




                        </style>
                        <script>
                            $(document).ready(function () {

                                $('#selectarea').change(function () {
                                    var area = $('#selectarea').val();
                                    var opt = $("#selectarea option[value='"+area+"']").html();

                                    $("#assunto_subject").attr("value",opt);

                                    if (area == "reclama-ccedil--otilde-es") {
                                        $('#bloco_reclamanacao').show();
                                        $(":input:not(#autorizacao):not(#complemento)").attr("required", "true");

                                    } else {

                                        $('#bloco_reclamanacao').hide();
                                        $(":input:not(#autorizacao):not(#complemento)").attr("required", "true");
                                    }


                                    /*      $("#autorizacao").attr("required", "false");
                                          $("#fileimage").attr("required", "false");*/

                                });

                                $(".lblSel select").change(function(){
                                    var valor = $(this).val();
                                    if(valor != ""){
                                        $(this).parents("label").addClass("selecionado");
                                    }else{
                                        $(this).parents("label").removeClass("selecionado");
                                    }

                                });
                            });
                        </script>

                        <li>
                            <div class="label"><h3>{Informações Pessoais}</h3></div>
                            <div class="contactFields">
                                <div>
                                    <input <?php $this->formValues($this->values, "name"); ?> type="text" name="name" placeholder="* {Nome}:">
                                    <label class="lblSel" for="gender" title="* {Sexo}: ">
                                        <select id="gender" class="selectchange" name="gender">
                                            <option value="">* {Sexo}:</option>
                                            <option <?php $this->formValues($this->values, "gender", "option", "feminino"); ?>
                                                value="feminino">{Female}
                                            </option>
                                            <option <?php $this->formValues($this->values, "gender", "option", "masculino"); ?>
                                                value="masculino">{Masculine}
                                            </option>
                                        </select>
                                    </label>
                                </div>
                                <div>
                                    <input type="text" <?php $this->formValues($this->values, "birth"); ?> name="birth" class="data" placeholder="* {Birthday}: ">

                                    <label class="lblSel" for="relationship" title="{Relationship}: ">
                                        <select id="relationship" class="selectchange" name="relationship">
                                            <option value="">* {Relationship}:</option>
                                            <option <?php $this->formValues($this->values, "relationship", "option", "Solteiro(a)"); ?>
                                                value="Solteiro(a)">{Solteiro(a)}
                                            </option>
                                            <option <?php $this->formValues($this->values, "relationship", "option", "Casado(a)"); ?>
                                                value="Casado(a)">{Casado(a)}
                                            </option>

                                            <option <?php $this->formValues($this->values, "relationship", "option", "Separado(a)"); ?>
                                                value="Separado(a)">{Separado(a)}
                                            </option>
                                            <option <?php $this->formValues($this->values, "relationship", "option", "Divorciado(a)"); ?>
                                                value="Divorciado(a)">{Divorciado(a)}
                                            </option>
                                            <option <?php $this->formValues($this->values, "relationship", "option", "Viuvo(a)"); ?>
                                                value="Viuvo(a)">{Viuvo(a)}
                                            </option>
                                            <option <?php $this->formValues($this->values, "relationship", "option", "Outros"); ?>
                                                value="Outos">{Outros}
                                            </option>
                                        </select>
                                    </label>


                                    <input type="text" <?php $this->formValues($this->values, "cpf"); ?> name="cpf"
                                           placeholder="* {CPF}:">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="label"><h3>{Dados de Contato}</h3></div>
                            <div class="contactFields">
                                <div>
                                    <input type="text" <?php $this->formValues($this->values, "cellphone"); ?>
                                           name="cellphone" placeholder="* {Cellphone}:">
                                    <input type="text" <?php $this->formValues($this->values, "phone"); ?> name="phone"
                                           placeholder="* {Fixo}:">
                                </div>
                                <div>
                                    <input type="email" <?php $this->formValues($this->values, "email"); ?> name="email"
                                           placeholder="* E-mail:">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="label"><h3>{Sua Localização}</h3></div>
                            <div class="contactFields">
                                <div>
                                    <input type="text"
                                           name="zipcode" <?php $this->formValues($this->values, "zipcode"); ?>
                                           placeholder="* {CEP}:">
                                    <input type="text"
                                           name="address" <?php $this->formValues($this->values, "address"); ?>
                                           placeholder="* {Address}:">
                                </div>
                                <div>
                                    <input type="text" <?php $this->formValues($this->values, "number"); ?>
                                           name="number" placeholder="* {Número}:">
                                    <input type="text" <?php $this->formValues($this->values, "additional"); ?>
                                           name="additional" placeholder="{Complemento}: " id="complemento">
                                    <input type="text" <?php $this->formValues($this->values, "address2"); ?>
                                           name="address2" placeholder="* {Bairro}:">
                                </div>
                                <div>
                                    <label for="country" title="* {País}" class="lblSel">
                                        <select id="country" class="selectchange " name="country">
                                            <option value="">* {País}:</option>
                                            <?php foreach ($this->paises as $key => $pais) {
                                                if ($key == "BR") {
                                                    $selected = "selected";
                                                } else {
                                                    $selected = "";
                                                }
                                                ?>
                                                <option <?php $this->formValues($this->values, "country", "option", $key); ?>
                                                    value="<?php echo($key); ?>" <?= $selected ?>><?php echo($pais); ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>

                                    <script>
                                        $(document).ready(function () {

                                            $('#country').change(function () {

                                                var country = $('#country').val();

                                                if (country != "BR") {

                                                    $('#state_combo').fadeOut();
                                                    $('#city_combo').fadeOut();

                                                } else {
                                                    $('#state_combo').fadeIn();
                                                    $('#city_combo').fadeIn();
                                                }

                                            });
                                            $('#state').change(function () {

                                                var estado = $('#state').val();

                                                $("#city").html('<option value="">Cidade: </option>');
                                                $.ajax({
                                                    url: "/lista-cidades",
                                                    data: {"estado": estado},
                                                    type: "POST",
                                                    dataType: "JSON",
                                                    success: function (data) {

                                                        for (var i in data) {

                                                            $("#city").append('<option value="' + i + '">' + data[i] + '</option>');

                                                        }
                                                    }
                                                });


                                            });

                                            $("input").blur(function(){
                                                var value = $(this).val();
                                                $(this).val(value.toUpperCase());
                                            });

                                            $("textarea").blur(function(){
                                                var value = $(this).val();
                                                $(this).val(value.toUpperCase());

                                            });

                                        });
                                    </script>
                                    <!-- <input type="text" <?php $this->formValues($this->values, "country"); ?> name="country" placeholder="{País}: ">-->

                                    <label for="state" title="* {State}" class="lblSel" id="state_combo">
                                        <select id="state" class="selectchange " name="state">
                                            <option value="">* {State}:</option>
                                            <?php foreach ($this->estados as $key => $estado) {
                                                ?>
                                                <option <?php $this->formValues($this->values, "state", "option", $key); ?>
                                                    value="<?php echo($key); ?>"><?php echo($estado); ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                    <!-- <input type="text" <?php $this->formValues($this->values, "state"); ?> name="state" id="state" placeholder="{State}: ">-->


                                    <label for="state" title="* {City}" class="lblSel" id="city_combo">
                                        <select id="city" class="selectchange " name="city">
                                            <option value="">* {City}:</option>

                                        </select>
                                    </label>
                                    <!-- <input type="text" <?php $this->formValues($this->values, "city"); ?> name="city" id="city" placeholder="{City}: ">-->
                                </div>
                            </div>
                        </li>
                        <li id="bloco_reclamanacao" style="display: none">

                            <div class="label"><h3>{Produto}</h3></div>
                            <div class="contactFields">
                                <div>
                                    <label for="selectproduto" title="* {Produto}" class="lblSel" style="width: 100%;">
                                        <select id="selectproduto" class="selectchange " name="produto">
                                            <option value="">* {Produto}:</option>
                                            <?php foreach ($this->categorias as $key => $categoria) {
                                                ?>
                                                <option <?php $this->formValues($this->values, "produto", "option", $categoria); ?>
                                                    value="<?php echo($categoria); ?>"><?php echo($categoria); ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </div>
                                <div>
                                    <input type="text" name="data_fabricacao" id="data_fabricacao" class="data"
                                           placeholder="* {Data de Fabricação}:" <?php $this->formValues($this->values, "data_fabricacao"); ?>>
                                </div>
                                <div>
                                    <input type="text" name="data_validade" id="data_validade" class="data"
                                           placeholder="* {Data de Validade}:" <?php $this->formValues($this->values, "data_fabricacao"); ?>>
                                </div>

                                <script>
                                    $(document).ready(function () {

                                        $('#formulario_contato').submit(function(){

                                            var ret = true;
                                            var fields = $(':input', $(this));
                                            fields.each(function(){

                                                var name = $(this).attr("name");
                                                var required = $(this).attr("required");
                                                var valor = $(this).val();

                                                if(required != ""){

                                                    switch (name){
                                                        case "birth":
                                                            if(valor.length != 10){
                                                            alert("{Data de nascimento incorreta}")
                                                                ret = false;
                                                            }
                                                            break;
                                                        case "cpf":
                                                            if(valor.length != 14){
                                                                alert("{CPF incorreto}")
                                                                ret = false;
                                                            }
                                                            break;
                                                        case "cellphone":
                                                            if(valor.length != 15){
                                                                alert("{Celular incorreto}")
                                                                ret = false;
                                                            }
                                                            break;
                                                        case "phone":
                                                            if(valor.length != 14){
                                                                alert("{Telefone incorreto}")
                                                                ret = false;
                                                            }
                                                            break;
                                                        case "zipcode":
                                                            if(valor.length != 9){
                                                                alert("{CEP incorreto}")
                                                                ret = false;
                                                            }
                                                            break;
                                                    }

                                                }

                                            });

                                            return ret;
                                        });

                                        $('#lote').keyup(function () {
                                            this.value = this.value.replace(/[^a-zA-Z0-9.]/g, '');
                                        });


                                        $(".data").blur(function(){
                                            var tthis = $(this);
                                            var data = validaData($(this).val());
                                            console.log(tthis);
                                            console.log(data);


                                            switch (data){
                                                /*case -18:
                                                    alert('SOMENTE MAIORES DE 18 ANOS PODEM SE CADASTRAR !');
                                                    break;*/
                                                case 100:
                                                    alert('DATA INCORRETA');
                                                    tthis.val("");
                                                    break;
                                                case false:
                                                    alert('DATA INCORRETA');
                                                    tthis.val("");

                                                    break;
                                                default:

                                            }
                                        });
                                    });

                                    function validaData(data,idadeMinima){
                                        var data = data.replace(/\D/gi,"");
                                        var dia = data.substr(0,2);
                                        var mes = data.substr(2,2);
                                        var ano = data.substr(4,4);
                                        var anoCorrente= new Date();
                                        if(idadeMinima){
                                            if(ano > anoCorrente.getFullYear() -idadeMinima){
                                                return -18; //not 18 years completed
                                            }
                                        }
                                        if((ano < anoCorrente.getFullYear()-100)){
                                            return +100; // > 100 years
                                        }else if((mes < 1) || (mes > 12)){
                                            return false;
                                        }else if((dia < 1) || (dia > 31)){
                                            return false;
                                        }else if(((mes == 4) || (mes == 6) || (mes == 9) || (mes == 11)) && (dia > 30)){
                                            return false;
                                        }else if((mes == 2) && (dia > 29)){
                                            return false;
                                        }else if((mes == 2) && (dia > 28) && (!(ano %4 == 0 && ((ano % 400 == 0) || (ano % 100 != 0))))){
                                            return false;
                                        }
                                        return true;
                                    }


                                </script>
                                <div>
                                    <input type="text" name="lote" id="lote" onKeypress="return apenasLetras(event)"
                                           placeholder="* {Lote}:"  <?php $this->formValues($this->values, "lote"); ?>>
                                </div>

                            </div>
                        </li>
                        <li>

                            <div class="label"><h3>{Mensagem}</h3></div>
                            <div class="contactFields">

                                <input type="text" style="display: none" name="subject" id="assunto_subject" placeholder="* {Assunto}:" <?php $this->formValues($this->values, "subject"); ?>>

                                <div>
                                    <textarea name="message"
                                              placeholder="* {Mensagem:}"><?php $this->formValues($this->values, "message", "textarea"); ?></textarea>
                                </div>
                                <div class="file">
                                    <label class="lblSel" for="fileimage" title="{Procurar}...">
                                        <input type="file" id="fileimage" class="filechange" name="image" placeholder="{Procurar}..."></label>
                                    <span>{TAM_INFO}.</span>
                                </div>
                                <div style="width: 317px">
                                    <input type="checkbox" name="autorizacao" id="autorizacao"> <label>{RECEBER_INFORMACOES}</label>
                                </div>
                                <div>
                                    <div class="captchaBox">
                                        <div class="g-recaptcha"
                                             data-sitekey="6LeuvyUTAAAAAHypU_0MnFL4YuR3PqNLMaa9l4SZ"></div>
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
    .captchaBox {
        border: 0;
        height: auto;
    }
</style>
