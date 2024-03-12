$(document).ready(function(){
    $('#transfer_date, #change_date, #warranty_start').pickadate({
        max: true, 
        monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
        monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
        weekdaysFull: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
        weekdaysShort: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
        today: 'วันนี้',
        clear: 'ลบ',
        format: 'dd-mm-yyyy',
        formatSubmit: 'dd-mm-yyyy',
        selectYears: 40,
        onRender: function () {
            var yearDropdown = this.$root.find('.picker__select--year');
            if (yearDropdown.length > 0) {
                yearDropdown.find('option').each(function () {
                    var westernYear = parseInt($(this).text());
                    var buddhistYear = westernYear + 543; 
                    $(this).text(buddhistYear);
                });
            }
        },
        onClose: function () {
            var selectedDate = this.get('select', 'dd-mm-yyyy');
            var parts = selectedDate.split('-');
            var buddhistYear = parseInt(parts[2]) + 543; 
            var formattedDate = parts[0] + '-' + parts[1] + '-' + buddhistYear; 
            this.$node.val(formattedDate); 
        }
        
        
    });
});
$(document).ready(function(){
    $('#exp_date, #warranty_end').pickadate({
        max: false, 
        monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
        monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
        weekdaysFull: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
        weekdaysShort: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
        today: 'วันนี้',
        clear: 'ลบ',
        format: 'dd-mm-yyyy',
        formatSubmit: 'dd-mm-yyyy',
        selectYears: 40,
        onRender: function () {
            var yearDropdown = this.$root.find('.picker__select--year');
            if (yearDropdown.length > 0) {
                yearDropdown.find('option').each(function () {
                    var westernYear = parseInt($(this).text());
                    var buddhistYear = westernYear + 543; 
                    $(this).text(buddhistYear);
                });
            }
        },
        onClose: function () {
            var selectedDate = this.get('select', 'dd-mm-yyyy');
            var parts = selectedDate.split('-');
            var buddhistYear = parseInt(parts[2]) + 543; 
            var formattedDate = parts[0] + '-' + parts[1] + '-' + buddhistYear; 
            this.$node.val(formattedDate); 
        }
        
        
    });
});