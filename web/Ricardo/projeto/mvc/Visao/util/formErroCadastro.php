<?php
//var_dump( "Teste do campo: ".$campo);

if($this->temErro($campo)): ?>
    <div class="center animated shake delay-1s">
        <small class="red-text"><?= $this->getErro($campo) ?></small>

    </div>
<?php endif ?>