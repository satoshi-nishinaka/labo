package iteration

import "testing"
import "strings"

func TestUsingStringsRepeat(t *testing.T) {
    repeated := strings.Repeat("a", 5)
    expected := "aaaaa"

    if repeated != expected {
        t.Errorf("expected %q but got %q", expected, repeated)
    }
}