<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="card">

<h1>Contact Messages</h1>

<table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($messages as $msg): ?>
            <tr style="<?= $msg['is_read'] ? 'background:#f9f9f9; color:#999;' : 'font-weight:bold;'; ?>">
                <td><?= $msg['id']; ?></td>
                <td><?= htmlspecialchars($msg['name']); ?></td>
                <td><a href="mailto:<?= htmlspecialchars($msg['email']); ?>"><?= htmlspecialchars($msg['email']); ?></a></td>
                <td><?= htmlspecialchars($msg['subject']); ?></td>
                <td><?= nl2br(htmlspecialchars($msg['message'])); ?></td>
                <td><?= $msg['created_at']; ?></td>
                <td><?= $msg['is_read'] ? 'Read' : 'Unread'; ?></td>
                <td>
                    <?php if(!$msg['is_read']): ?>
                        <a href="<?= BASE_URL; ?>/messages?mark_read=<?= $msg['id']; ?>">Mark as Read</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>
