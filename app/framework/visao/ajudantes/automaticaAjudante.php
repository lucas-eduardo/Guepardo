<div class="col-md-9 ajudantes-content conteudo-lateral" ng-if="aju.automatico">

    <h2 class="ajudantes-title">Carregamento Automático de Ajudantes</h2>

    <p class="primeirospassos-text">

        O carregamento automático parte do arquivo <code>autocarregamento.php</code> que se encontra em <code>suaaplicacao/app/aplicacao/config/autocarregamento.php</code>, nele você encontrará <code>$autocarregar['ajudante'] = array();</code> e <code>$autocarregar['biblioteca'] = array();</code>, para realizar o autocarregamento do ajudante, basta passar o nome dele no array, por exemplo: <code>$autocarregar['ajudante'] = array("texto");</code>, ai todo o basta chama a função normalmente onde desejar do seu projeto.

    </p>

</div>