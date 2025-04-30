<footer class="footer-04 py-5 text-light text-decoration-none" style="background-color: #3D281C">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                <h5 class="footer-heading"><p href="#" class="logo"><img src="{{asset('image/light-logo.png')}}" height="40" /></p></h5>
                <p>"LUXORA Jewellers",125, Subhash Nagar, Near Jubilee Garden, Rajkot, Gujarat 360001</p>
            </div>
            <div class="col-md-6 col-lg-2 mb-md-0 mb-4">
                <h2 class="footer-heading">Categories</h2>
                <ul class="list-unstyled">
                    <li><a href="{{url('subcategory/1')}}" class="py-1 d-block text-decoration-none text-white">Rings</a></li>
                    <li><a href="{{url('subcategory/6')}}" class="py-1 d-block text-decoration-none text-white">Necklace</a></li>
                    <li><a href="{{url('subcategory/4')}}" class="py-1 d-block text-decoration-none text-white">Earings</a></li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-2 mb-md-0 mb-4">
                <h2 class="footer-heading">Occasions</h2>
                <div class="tagcloud">
                    <p href="#" class="tag-cloud-link">Wedding</p>
                    <p href="#" class="tag-cloud-link">Engagement</p>
                    <p href="#" class="tag-cloud-link">Regular Wear</p>
                    <p href="#" class="tag-cloud-link">Festival</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 mb-md-0 mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29537.954953993132!2d70.78187451546843!3d22.26873120136533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959ca7ecb46581f%3A0x8c56f6448dde780d!2sBhakti%20Nagar%2C%20Rajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1742533470265!5m2!1sen!2sin" class="w-100 h-100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</footer>
{{--footer--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        // Remove product from wishlist
        $('.heart').on('click', function() {
            var productId = $(this).data('product-id');
            var icon = $(this);
                $.ajax({
                    url: '/wishlist/' + productId,
                    type: 'GET',
                    success: function(response) {
                        if(response === 'add') { // if added
                            icon.addClass('fa-solid');
                            icon.removeClass('fa-regular');
                        }
                        else { // if removed
                            icon.removeClass('fa-solid');
                            icon.addClass('fa-regular');
                        }
                    },
                    error: function(error) {
                        alert('Error in removing product.... !');
                    }
                });
        });

        $('.cart').on('click', function() {
            var productId = $(this).data('product-id');
            var card = $('#cart-item-'+productId);
                $.ajax({
                    url: '/cart/remove/' + productId,
                    type: 'GET',
                    success: function(response) {
                        if(response === 'remove') { // if added
                            card.remove();
                            $('#success-alert').addClass('show');
                            $('#message').html('Product removed from cart successfully!');
                        }
                    },
                    error: function(error) {
                        alert('Error in removing product.... !');
                    }
                });
        });

    });

</script>
</body>
</html>
