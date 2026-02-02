


<!-- FontAwesome for icons -->


<?php $__env->startSection('content'); ?>

<style>
    body {
        background-color: #f5f6fa;
    }

    .job-container {
        max-width: 1100px;
        margin: 2rem auto;
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        font-family: 'Inter', sans-serif;
    }

    .job-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .job-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .badge {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .badge.bg-success { background: #28a745; color: #fff; }
    .badge.bg-danger { background: #dc3545; color: #fff; }

    .job-section {
        margin-top: 2rem;
    }

    .job-section h3 {
        font-size: 1.3rem;
        font-weight: 600;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
        color: #333;
    }

    .job-details .detail {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 0.6rem;
    }

    .job-details .label {
        width: 180px;
        font-weight: 600;
        color: #555;
    }

    .attachments {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .attachment-card {
        background: #f9f9f9;
        padding: 1rem;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: space-between;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }

    .attachment-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .attachment-card i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .attachment-name {
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        word-break: break-word;
    }

    .attachment-card img {
    object-fit: contain;
    display: block;
    margin-bottom: 0.5rem;
}
.attachment-card .attachment-name {
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
    word-break: break-word;
}

   

    .btn-load-more {
        display: block;
        margin: 1.5rem auto 0;
        padding: 0.6rem 1.2rem;
        background: #556ee6;
        color: #fff;
        border-radius: 6px;
        cursor: pointer;
        text-align: center;
        transition: background 0.2s;
    }

    .btn-load-more:hover {
        background: #3657c3;
    }

    /* Responsive */
    @media(max-width: 768px) {
        .job-details .label { width: 120px; }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pap3eFfZjl/Y1k4n3kFqMxjruT3kWj9+p+5lM8e1/GBK3iP1tIKG/9Oy5gjy8lZ8+eHdfm+0H+lTtq0BhfR0Ew==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="job-container">
    <!-- Header -->
    <div class="job-header">
        <h2>Job Preview - <?php echo e($job['generated_job_id'] ?? $job['uuid']); ?></h2>
        <span class="badge <?php echo e($job['active'] ? 'bg-success' : 'bg-danger'); ?>">
            <?php echo e($job['active'] ? 'Active' : 'Inactive'); ?>

        </span>
    </div>

    <!-- Job Information Sections -->
    <div class="job-section job-details">
        <h3>Job Details</h3>
        <div class="detail"><div class="label">Date:</div> <?php echo e($job['date'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Status:</div> <?php echo e($job['status'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Job Address:</div> <?php echo e($job['job_address'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Job Description:</div> <?php echo e($job['job_description'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Work Done:</div> <?php echo e($job['work_done_description'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Generated ID:</div> <?php echo e($job['generated_job_id'] ?? '—'); ?></div>
    </div>

    <div class="job-section job-details">
        <h3>Payment & Invoice</h3>
        <div class="detail"><div class="label">Total Invoice Amount:</div> <?php echo e($job['total_invoice_amount'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Payment Received:</div> <?php echo e($job['payment_received'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Payment Date:</div> <?php echo e($job['payment_date'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Payment Method:</div> <?php echo e($job['payment_method'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Completion Date:</div> <?php echo e($job['completion_date'] ?? '—'); ?></div>
    </div>

    <div class="job-section job-details">
        <h3>Location & Queue</h3>
        <div class="detail"><div class="label">Geo Country:</div> <?php echo e($job['geo_country'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Geo State:</div> <?php echo e($job['geo_state'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Geo City:</div> <?php echo e($job['geo_city'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Geo Street:</div> <?php echo e($job['geo_street'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Queue UUID:</div> <?php echo e($job['queue_uuid'] ?? '—'); ?></div>
        <div class="detail"><div class="label">Queue Assigned Staff:</div> <?php echo e($job['queue_assigned_staff_uuid'] ?? '—'); ?></div>
    </div>

    <!-- Attachments -->
    <div class="job-section">
        <h3>Attachments</h3>
        <div id="attachments" class="attachments"></div>
        <div id="loadMoreAttachments" class="btn-load-more" style="display:none;">Load More</div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
const jobUuid = "<?php echo e($job['uuid']); ?>";
let attachmentsCursor = '-1';
const attachmentsContainer = document.getElementById('attachments');
const loadMoreBtn = document.getElementById('loadMoreAttachments');

// Get icon class based on file type
function getIconImage(fileType) {
    if (!fileType) return 'https://cdn-icons-png.flaticon.com/512/109/109612.png'; // generic file

    fileType = fileType.toLowerCase();

    if (fileType.includes('pdf')) return 'https://cdn-icons-png.flaticon.com/512/337/337946.png';
    if (['.jpg', '.jpeg', '.png', '.gif'].some(ext => fileType.includes(ext))) return 'https://cdn-icons-png.flaticon.com/512/136/136524.png';
    if (['.doc', '.docx'].some(ext => fileType.includes(ext))) return 'https://cdn-icons-png.flaticon.com/512/337/337932.png';
    if (['.xls', '.xlsx'].some(ext => fileType.includes(ext))) return 'https://cdn-icons-png.flaticon.com/512/337/337948.png';
    if (['.zip', '.rar'].some(ext => fileType.includes(ext))) return 'https://cdn-icons-png.flaticon.com/512/136/136549.png';
    return 'https://cdn-icons-png.flaticon.com/512/109/109612.png'; // fallback
}

// Fetch attachments
function fetchAttachments() {
    fetch(`<?php echo e(url('servicem8/jobs')); ?>/${jobUuid}/attachments?cursor=${attachmentsCursor}`)
    .then(res => res.json())
    .then(data => {
        const attachments = Array.isArray(data) ? data : (data.data || []);
        const next_cursor = data.next_cursor || null;

        attachments.forEach(att => {
            const div = document.createElement('div');
            div.classList.add('attachment-card');
            div.innerHTML = `
               <img src="${getIconImage(att.file_type)}" alt="file icon" style="width:48px; height:48px; margin-bottom:0.5rem;">
                <div class="attachment-name">${att.attachment_name}${att.file_type}</div>
                <a href="<?php echo e(url('servicem8/attachment/download')); ?>/${att.uuid}" target="_blank">Download</a>
            `;
            attachmentsContainer.appendChild(div);
        });

        if(next_cursor) {
            attachmentsCursor = next_cursor;
            loadMoreBtn.style.display = 'block';
        } else {
            loadMoreBtn.style.display = 'none';
        }
    })
    .catch(err => console.error(err));
}

// Initial fetch
fetchAttachments();

// Load more
loadMoreBtn.addEventListener('click', fetchAttachments);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($type == 'client' ? 'layouts.app1' : 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/servicem8/jobs/show.blade.php ENDPATH**/ ?>