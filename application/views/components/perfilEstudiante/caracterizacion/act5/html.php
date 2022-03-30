<<?= $components->infoBasica ?>

<?= $components->menuPE ?>
<div class="row linea-separadora">
    <div class="col-lg-12">
        <hr size="8px" color="black" />
    </div>
</div>
<?= $components->menuDPE ?>

<div class="col-xs-12">
<div class="row form-horizontal">

    <div class="form-group">
        <h1>Descripción familiar </h1>
    </div>
                
  <table class="form-group">
                <tr>
                    <td>
                        <h3 class="col-xs-11">1.  ¿Quién soy?</h3>
                        <textarea name="pregunta1" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php echo $actividad5d[0]->pregunta1 ?></textarea>
                    </td>
                    <td>
                        <h3 class="col-xs-11">2.  ¿Qué pienso de mi entorno social y familiar?</h3>
                        <textarea name="pregunta2" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php echo $actividad5d[0]->pregunta2 ?></textarea>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">3.  ¿Cómo veo al estudiante?</h3>
                        <textarea name="pregunta3" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php echo $actividad5d[0]->pregunta3 ?></textarea>
                    </td>
                    </td>
                    <td>
                        <h3 class="col-xs-11">4.  ¿Cómo apoyo al estudiante?</h3>
                        <textarea name="pregunta4" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php echo $actividad5d[0]->pregunta4 ?></textarea>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <h3 class="col-xs-11">5.  ¿En qué me comprometo con el desarrollo del estudiante?</h3>
                        <textarea name="pregunta5" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php echo $actividad5d[0]->pregunta5 ?></textarea>
                    </td>
                    <td>
                        <h3 class="col-xs-11">6.  ¿Cómo me siento integrado al colegio?</h3>
                        <textarea name="pregunta6" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php echo $actividad5d[0]->pregunta6 ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">7.  ¿Cómo espero ser tratado en el colegio?</h3>
                        <textarea name="pregunta7" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php echo $actividad5d[0]->pregunta7 ?></textarea>
                    </td>
                    <td>
                        <h3 class="col-xs-11">8.  ¿Cómo aporto al colegio?</h1>
                        <textarea name="pregunta8" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php echo $actividad5d[0]->pregunta8 ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="col-xs-11">9.  ¿Relate una experiencia positiva con el Usuario 1?</h1>
                        <textarea name="pregunta9" readonly="readonly" data-rel="tooltip" class="col-xs-11" placeholder="Escribe aquí tus comentarios"><?php echo $actividad5d[0]->pregunta9 ?></textarea>
                    </td>
                </tr>           
            </table>

        
    
    </div>

</div>