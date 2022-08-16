$(document).ready(function () {
    initFontScale()
    $('#font-size-page-increase').click(function () {
        let scale = getFontScale() + 0.05
        if (scale > 1.5) {
            scale = 1.5
        }
        setFontScale(scale)
        document.documentElement.style.setProperty('--font-size-scale', scale)
    })
    $('#font-size-page-decrease').click(function () {
        let scale = getFontScale() - 0.05
        if (scale < 0.5) {
            scale = 0.5
        }
        setFontScale(scale)
        document.documentElement.style.setProperty('--font-size-scale', scale)
    })
    $('#font-size-reset').click(function () {
        let scale = 1.0
        setFontScale(scale)
        document.documentElement.style.setProperty('--font-size-scale', scale)
    })

    $('.date-picker').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            up: "fas fa-chevron-up",
            down: "fas fa-chevron-down",
            next: 'fas fa-chevron-right',
            previous: 'fas fa-chevron-left'
        }
    })

    const totalPrice = $('.total-price')
    if (totalPrice.length) {
        totalPrice.each(function (index, element) {
            calcTotalPrice(element)
        })
    }

    $('.product-quantity-minus').click(function (e) {
        let quantity = $(this).parent().find('.product-quantity')
        let val = parseInt(quantity.val()) - 1
        if (val >= parseInt(quantity.attr('min'))) {
            quantity.val(val)
        }

        if (totalPrice.length) {
            calcTotalPrice($(this).closest('tr').find('.total-price.cart-total-price'))
            cartQuantityChange($(this).closest('form.cart-form-quantity'))
            changeQuantity()
        }
    })

    $('.product-quantity-plus').click(function (e) {
        let quantity = $(this).parent().find('.product-quantity')
        let val = parseInt(quantity.val()) + 1
        if (val <= parseInt(quantity.attr('max'))) {
            quantity.val(val)
        }

        if (totalPrice.length) {
            calcTotalPrice($(this).closest('tr').find('.total-price.cart-total-price'))
            cartQuantityChange($(this).closest('form.cart-form-quantity'))
            changeQuantity()
        }
    })

    $('.product-quantity').change(function (e) {
        if (totalPrice.length) {
            calcTotalPrice($(this).closest('tr').find('.total-price.cart-total-price'))
            cartQuantityChange($(this).closest('form.cart-form-quantity'))
        }
    })

    $('.cart-form-remove').submit(function (e) {
        e.preventDefault()

        let formData = new FormData(this)
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        })

        $(this).closest('tr').remove()
        calcTotalPrice()
        changeQuantity()
    })

    $('.filter-price-range').each(function (index, element) {
        let max = parseFloat($(element).data('max'))
        let initMin = parseFloat($(element).data('init-min'))
        let initMax = parseFloat($(element).data('init-max'))
        console.log([initMin, initMax])
        noUiSlider.create(element, {
            start: [initMin, initMax],
            connect: true,
            range: {
                'min': 0,
                'max': max
            }
        })

        element.noUiSlider.on('update', function (e) {
            let val = element.noUiSlider.get()
            $('.filter-price-range-min').val(val[0])
            $('.filter-price-range-max').val(val[1])
        })
    })

    $('.filter-price-range-min').change(function () {
        let min = $(this).val()
        let max = $('.filter-price-range-max').val()
        $('.filter-price-range').each(function (index, element) {
            element.noUiSlider.set([min, max])
        })
    })
    $('.filter-price-range-max').change(function () {
        let min = $('.filter-price-range-min').val()
        let max = $(this).val()
        $('.filter-price-range').each(function (index, element) {
            element.noUiSlider.set([min, max])
        })
    })
})

function getFontScale() {
    let scale = document.documentElement.style.getPropertyValue('--font-size-scale');
    if (scale === '') {
        scale = 1.0
    } else {
        scale = parseFloat(scale);
    }
    return scale;
}

function initFontScale() {
    let localScale = localStorage.getItem('font-size-scale')
    if (localScale === null) {
        localStorage.setItem('font-size-scale', getFontScale())
    } else {
        document.documentElement.style.setProperty('--font-size-scale', localScale)
    }
}

function setFontScale(scale = null) {
    if (scale !== null) {
        localStorage.setItem('font-size-scale', scale)
    }
}

function calcTotalPrice(element = null) {
    if ($(element).hasClass('cart-total-price')) {
        let table = $(element).closest('tr')
        let price = table.find('.cart-price').text()
        let quantity = parseInt(table.find('.product-quantity').val())

        let price_num = parseFloat(price)

        let out = (price_num * quantity).toFixed(2)

        $(element).text(out)
    }

    let c_price = 0
    $('.cart-total-price').each(function (index, element) {
        let price_num = parseFloat($(element).text())
        c_price += price_num
    })
    $('.cart-price-total').text(c_price.toFixed(2))
}

function cartQuantityChange(element) {
    let formData = new FormData(element[0])
    $.ajax({
        url: element.attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
    })

    changeQuantity()
}

function changeQuantity() {
    let c = 0;
    $('.product-quantity').each(function (index, element) {
        let i = parseInt($(element).val())
        c += i
    })
    $('.cart-quantity-total').text(c)
}
