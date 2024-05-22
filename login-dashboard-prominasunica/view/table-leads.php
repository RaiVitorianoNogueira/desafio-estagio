<?php
include_once ('../dao/LeadsDao.php');
try {
    
    $leadsDao = LeadsDao::getInstance();


    $stmt = $leadsDao->findAll();
    if ($stmt !== null) {
        
        $leads = $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        throw new Exception("Failed to retrieve leads.");
    }

    

} catch (Exception $e) {
    
    error_log("Error fetching leads: " . $e->getMessage());

    
    echo "An error occurred while fetching leads. Please try again later.";

    
}

?>


<?php if (!empty($leads)): ?>
    <?php foreach ($leads as $dados): ?>
        


        
    <?php endforeach; ?>
<?php else: ?>
    <p>No leads available.</p>
<?php endif; 
?>


    
        
    <?php if (!empty($leads)): ?>
    <?php foreach ($leads as $dados): ?>
        <tr>
            <td class="text-center">
                <i onclick="editLead(
                    '<?php echo htmlspecialchars($dados->id, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($dados->nome, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($dados->email, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($dados->whatsapp, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($dados->curso_interesse, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($dados->cidade, ENT_QUOTES, 'UTF-8'); ?>'
                )" data-toggle="modal" data-target="#ModalEditLead" class="fa fa-edit" style="cursor: pointer"></i>

                <i class="fa fa-trash pointer color-red" onclick="deleteLead(
                    <?php echo htmlspecialchars($dados->id, ENT_QUOTES, 'UTF-8'); ?>,
                    '<?php echo htmlspecialchars($dados->nome, ENT_QUOTES, 'UTF-8'); ?>'
                )" data-toggle="modal" data-target="#modalDeleteLead" title="Excluir Lead"></i><br><br>
            </td>
            
            <td class="text-center">
                <span class="perfil-unica">
                    <input type="text" id="nome-atualizar-<?php echo htmlspecialchars($dados->id, ENT_QUOTES, 'UTF-8'); ?>" class="form-control" style="width: 200px" value="<?php echo htmlspecialchars($dados->nome, ENT_QUOTES, 'UTF-8'); ?>">
                </span>
            </td>
            
            <td class="text-center">
                <?php echo htmlspecialchars($dados->curso_interesse, ENT_QUOTES, 'UTF-8'); ?>
            </td>

            <td class="text-center">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=55<?php echo htmlspecialchars($dados->whatsapp, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($dados->whatsapp, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </td>
            
            <td class="text-center">
                <?php echo htmlspecialchars($dados->cidade, ENT_QUOTES, 'UTF-8'); ?>
            </td>
        
            <td class="text-center">
                <?php echo htmlspecialchars(date('d/m/Y', strtotime($dados->data)), ENT_QUOTES, 'UTF-8'); ?>
            </td>
            
            <td class="text-center">
                <?php echo htmlspecialchars($dados->email, ENT_QUOTES, 'UTF-8'); ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="7" class="text-center text-uppercase"><b>Nenhum registro encontrado!</b></td>
    </tr>
<?php endif; ?>


