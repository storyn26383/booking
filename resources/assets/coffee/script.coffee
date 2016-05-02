$ document
    .on 'click', '[data-method=DELETE]', (e) ->
        noty
            theme: 'relax'
            type: 'confirm'
            layout: 'center'
            modal: true
            text: '<h4>您真的要刪除嗎？</h4>'
            animation:
                open: 'animated bounceInDown'
                close: 'animated bounceOutUp'
            buttons:
                [
                    text: '返回'
                    addClass: 'btn btn-default'
                    onClick: ($noty) ->
                        $noty.close()
                ,
                    text: '刪除'
                    addClass: 'btn btn-danger'
                    onClick: ($noty) =>
                        token = $('meta[name="csrf-token"]').attr 'content'

                        $('<form action="' + @href + '" method="POST">')
                            .hide()
                            .append '<input type="hidden" name="_method" value="DELETE">'
                            .append '<input type="hidden" name="_token" value="' + token + '">'
                            .appendTo $('body')
                            .submit()
                ]

        e.preventDefault()
    .on 'click', '.calendar .progress-bar-success', (e) ->
        $ '.calendar .progress-bar-info'
            .removeClass 'progress-bar-info'
            .addClass 'progress-bar-success'

        $ @
            .removeClass 'progress-bar-success'
            .addClass 'progress-bar-info'

        $ '.selected-date'
            .val $(@).data('date')

        $ '.next-step'
            .removeClass 'hide'
    .on 'change', '.room-radio', (e) ->
        $ '.next-step'
            .removeClass 'hide'
