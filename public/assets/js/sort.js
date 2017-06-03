var sort = (function() {
    /* =============================================================
        QUICK SORT
    ==============================================================*/
    quicksort = function(array, l, r, cmp) {
        if (l >= r) {
            return;
        }

        var split = partition(array, l, r, cmp);

        if (split - 1 > l) {
            quicksort(array, l, split - 1, cmp);
        }

        if (split + 1 < r) {
            quicksort(array, split + 1, r, cmp);
        }
    }

    function partition(array, l, r, cmp) {
        var pivot = array[l];
        var i = l + 1;
        var j = r;

        while (i <= j) {
            while (cmp(array[i], pivot) === -1 && i < r) {
                i++;
            }

            while (cmp(array[j], pivot) === 1) {
                j--;
            }

            // prevent incorrect swap when i > j
            if (i <= j)
            {
                var temp = array[i];
                array[i] = array[j];
                array[j] = temp;
                i++;
            }
        }

        var temp = array[l];
        array[l] = array[j];
        array[j] = temp;

        return j;
    }

    /* =============================================================
        MERGE SORT
    ==============================================================*/
    mergesort = function(array, cmp) {
        if (array.length < 2) { 
            return;
        }

        var left = [];
        var right = [];
      
        // split the array provided into left and right partitions
        for (var i = 0; i < Math.floor(array.length / 2); i++) {
            left.push(array[i]);
        }
      
        for (var i = 0; i < Math.ceil(array.length / 2); i++) {
            right.push(array[left.length + i]);
        }
      
        // recursively split the partitions
        mergesort(left, cmp);
        mergesort(right, cmp);
      
        // sort and merge the partitions
        merge(left, right, array, cmp);
    }

    function merge(left, right, array, cmp) {
        // trivial merge - last element of left is less than the
        // first element of right
        if (left[left.length - 1].score < right[0].score) {
            for (var i = 0; i < left.length; i++) {
                array[i] = left[i];
            }
        
            for (var i = 0; i < right.length; i++) {
                array[left.length + i] = right[i];
            }
        
            return;
        }
      
        var l = 0;
        var r = 0;
        var index = 0;

        while (l < left.length && r < right.length) {
            if (cmp(left[l], right[r]) === -1) {
                array[index++] = left[l++];
            }
            else {
                array[index++] = right[r++];
            }
        }

        while (l < left.length) {
            array[index++] = left[l++];
        }

        while (r < right.length) {
            array[index++] = right[r++];
        }
    }

    return {
        quick: quicksort,
        merge: mergesort
    }
})();