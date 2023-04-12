<div class="text-center gold blackClover">
    <h1><span class="bdRenaissanceH1">M</span>es <span class="bdRenaissanceH1">M</span>essages</h1>
</div>
<p class="pt-2"><?= $message ?? '' ?></p>

<!-- table start -->
<table class="dashboardUsers1 bgBlue mt-0 p-1 fondamento text-center mb-1">    
    <tr class="bgBlue">
        <th>Date</th>
        <th>Message</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($comments as $comment) { ?>
        <tr class="bgWhite">
            <td><?= date('d-m-Y H:i', strtotime($comment->created_at)) ?></td>
            <td><?= stopText($comment->notice) ?></td>
            <td><a href="/controllers/userAccount/Comments/updateCommentCtrl.php?id_comments=<?= $comment->id_comments ?>"><img src="/public/assets/img/loupe.png" alt="icône loupe"></a>
                <a href="/controllers/userAccount/Comments/deleteCommentCtrl.php?id_comments=<?= $comment->id_comments ?>"><img class="ms-2" src="/public/assets/img/supprimer.png" alt="icône poubelle"></a>
            </td>
        </tr>
    <?php } ?>
</table>
<!-- table end -->