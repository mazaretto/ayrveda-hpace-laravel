$(document).ready(function () {
  $('.chat-compose').click(function (event) {
    let el = $(event.target).closest('.chat-header').find('.chat-add')
    if (el.hasClass('active')) {
      el.removeClass('active')
    } else {
      el.addClass('active')
    }
  })

  $('.chat-add form').submit(function (event) {
    event.preventDefault()
    let form = $(event.target)


    axios.post(form.attr('action'), {
      id: form.find('input').first().val()
    }).then(res => {
      if (res.data.status === 'fail') {
        form.find('.text-danger').text(res.data.message);
        form.find('.text-primary').text(null);
      }
      if (res.data.status === 'ok') {
        form.find('.text-primary').text(res.data.message);
        form.find('.text-danger').text(null);
        window.location.reload()
      }
    })
  })
})
