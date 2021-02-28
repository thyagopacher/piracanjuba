<script>
    $(document).ready(function(){
        $(".buttonMore, .releaseMore").click(function(){
            var par = $(this).parent(".releaseMore");
            par.toggleClass("close");

            return false;
        });
    });
</script>


<!--  Receitas -->
<section id="insideContent">
    <div class="alignContent">
        <div class="recipeBox">
            <nav>
                <a href="" class="todas">Todas</a>
                <a href="" class="bebidas">Bebidas</a>
                <a href="" class="entradas">Entradas</a>
                <a href="" class="prato-principal">Prato Principal</a>
                <a href="" class="sobremesa">Sobremesa</a>
                <a href="" class="zero-lactose">Zero Lactose</a>
            </nav>
            <ul class="recipeList">


                <?php foreach($this->receitas as $receita){
                    ?>
                <li class="todas">
                    <div class="recipePhoto">
                        <a href="#"><img src="<?=$receita->getCNTFTO()->getFile()->getFormat("750x430");?>" width="750" height="430" /></a>
                    </div>
                    <div class="recipeDesc">
                        <h3><a href="#"><?=$receita->CNT_TIT?></a></h3>
                        <p><a href="#">De texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um ...</a></p>
                        <p class="txtCenter"><a href="#" class="button">Ler mais</a></p>
                    </div>
                </li>
                <?php } ?>
                <!-- <li class="bebidas">
                    <div class="recipePhoto">
                        <a href="#"><img src="images/holanda.jpg" width="750" height="430" /></a>
                    </div>
                    <div class="recipeDesc">
                        <h3><a href="#">Suco natural de morango com leite integral</a></h3>
                        <p><a href="#">De texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um ...</a></p>
                        <p class="txtCenter"><a href="#" class="button">Ler mais</a></p>
                    </div>
                </li>
                <li class="entradas">
                    <div class="recipePhoto">
                        <a href="#"><img src="images/holanda.jpg" width="750" height="430" /></a>
                    </div>
                    <div class="recipeDesc">
                        <h3><a href="#">Suco natural de morango com leite integral</a></h3>
                        <p><a href="#">De texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um ...</a></p>
                        <p class="txtCenter"><a href="#" class="button">Ler mais</a></p>
                    </div>
                </li>
                <li class="prato-principal">
                    <div class="recipePhoto">
                        <a href="#"><img src="images/castelo.jpg" width="750" height="430" /></a>
                    </div>
                    <div class="recipeDesc">
                        <h3><a href="#">Suco natural de morango com leite integral</a></h3>
                        <p><a href="#">De texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um ...</a></p>
                        <p class="txtCenter"><a href="#" class="button">Ler mais</a></p>
                    </div>
                </li>
                <li class="sobremesa">
                    <div class="recipePhoto">
                        <a href="#"><img src="images/holanda.jpg" width="750" height="430" /></a>
                    </div>
                    <div class="recipeDesc">
                        <h3><a href="#">Suco natural de morango com leite integral</a></h3>
                        <p><a href="#">De texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um ...</a></p>
                        <p class="txtCenter"><a href="#" class="button">Ler mais</a></p>
                    </div>
                </li>
                <li class="zero-lactose">
                    <div class="recipePhoto">
                        <a href="#"><img src="images/castelo.jpg" width="750" height="430" /></a>
                    </div>
                    <div class="recipeDesc">
                        <h3><a href="#">Suco natural de morango com leite integral</a></h3>
                        <p><a href="#">De texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um ...</a></p>
                        <p class="txtCenter"><a href="#" class="button">Ler mais</a></p>
                    </div>
                </li>-->
            </ul>
        </div>
        <?php $this->includePartial("default", "pagination"); ?>
    </div>

</section>
<!--  /Receitas -->
