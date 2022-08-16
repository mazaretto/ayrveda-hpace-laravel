$(document).ready(function () {
  $(document).on('keydown', '.multiline-input__js .new-line__js', function (e) {
    if (e.keyCode === 13) {
      e.preventDefault()

      if ($(this).val() === '') {
        return;
      }

      let parent = $(this).closest('.multiline-input__js')
      parent.append(parent.find('.multiline-input-blank__js').clone().removeClass('multiline-input-blank__js'))
      parent.find('.new-line__js').last().focus()
    }
  })

  $(document).on('paste', '.multiline-input__js .new-line__js', function (e) {
    e.preventDefault()
    let parent = $(this).closest('.multiline-input__js')
    let paste = e.originalEvent.clipboardData.getData('text').split(/\r?\n/)
    let index = 0
    paste.forEach(function (element) {
      if (element) {
        if (index === 0) {
          $(e.target).val(element)
        } else {
          parent.append(parent.find('.multiline-input-blank__js').clone().removeClass('multiline-input-blank__js'))
          parent.find('.new-line__js').last().focus().val(element)
        }
        index++
      }
    })
  })

  $(document).on('click', '.multiline-input__js .multiline-input-remove__js', function (e) {
    e.preventDefault()
    $(this).parent().remove()
  })

  $('.order_delivery').click(function () {
    let el = $(this.parentElement).find('.order_delivery__info')
    if (el.hasClass('active')) {
      el.removeClass('active')
    } else {
      el.addClass('active')
    }
  })
})
