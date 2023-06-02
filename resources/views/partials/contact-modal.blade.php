<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contact Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="contactForm" action="{{ route('contact.teacher') }}" method="POST">
                    @csrf
                    <input type="hidden" id="teacherId" name="teacher_id">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle the contact button click event
        $('.contact-button').on('click', function() {
            var teacherId = $(this).data('teacher-id');
            $('#teacherId').val(teacherId);
            $('#contactModal').modal('show');
        });

        // Handle the form submission
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // You can show a success message or perform any other actions
                    // Also, you can close the modal if needed:
                    // $('#contactModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.log(xhr.responseText);
                    // You can show an error message or perform any other actions
                }
            });
        });
    });
</script>
