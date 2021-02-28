<style>
    .coluna_tabela {
        width: 100px;
    }

    .coluna_tabela_excluir {
        width: 40px;
        cursor: pointer;
    }
</style>
<script>

    function excluirSession(linha_id) {

        $.ajax({
            url: "/adm/tabela.php",
            dataType: "get",
            data: {
                excluir_session: 1,
                linha_id: linha_id,
            },
            success: function (data) {

                $('.tabela_linha_' + linha_id).remove();


            }
        });
    }
</script>
<div class="box">
    <h3>Tabela Nutricional</h3>
    <div>
        <input type="text" id="tabela_valor_energetico" name="tabela_valor_energetico"
               rel="<?php echo($this->container); ?>" style="width:100px;" placeholder="Energetico"/>
        <input type="text" id="tabela_quantidade" name="tabela_quantidade" rel="<?php echo($this->container); ?>"
               style="width:100px;" placeholder="Quantidade"/>
        <input type="text" id="tabela_porcentagem" name="tabela_porcentagem" rel="<?php echo($this->container); ?>"
               style="width:100px;" placeholder="Porcentagem"/>
        <input type="button" class="addTabela" value="{Add}" rel="<?php echo($this->container); ?>"/>
        <p></p>
        <script>

            function excluiLinha(linha_id){
              $.ajax({
                url: "/adm/tabela.php?excluir=1&linha_id="+linha_id,
                method: "POST",
                success: function (data){
                    $('.tabela_linha_'+linha_id).remove();
                },
                error: function (data){
                  window.alert("Error ao salvar");
                }
              })

            }
        </script>
        <table class="tabListAdd">

            <?php
            if (!empty($this->tabelaNutricional[0])): ?>
                <?php foreach ($this->tabelaNutricional as $linha): ?>
                    <tr class="tabela_linha_<?php echo($linha->getTABELAID()); ?>">
                        <td class="coluna_tabela">
                            <input type="hidden" name="<?php echo($this->container); ?>[tabela][<?php echo($linha->getTABELAID()); ?>][tabela_valor_energetico]"
                                   value="<?php echo($linha->getTABELAVALORENERGICO()); ?>"/>
                            <?php echo($linha->getTABELAVALORENERGICO()); ?>
                        </td>
                        <td class="coluna_tabela">
                            <input type="hidden" name="<?php echo($this->container); ?>[tabela][<?php echo($linha->getTABELAID()); ?>][tabela_quantidade]"
                                   value="<?php echo($linha->getTABELAQUANTIDADE()); ?>"/>
                            <?php echo($linha->getTABELAQUANTIDADE()); ?>
                        </td>
                        <td class="coluna_tabela">
                            <input type="hidden" name="<?php echo($this->container); ?>[tabela][<?php echo($linha->getTABELAID()); ?>][tabela_porcentagem]"
                                   value="<?php echo($linha->getTABELAPORCENTAGEM()); ?>"/>
                            <?php echo($linha->getTABELAPORCENTAGEM()); ?>
                        </td>
                        <td class="coluna_tabela_excluir excluir_linha"
                            linha_id="<?php echo($linha->getTABELAID()); ?>" onclick='excluiLinha(<?php echo($linha->getTABELAID()); ?>)'>X
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
<!-- /Tags -->
