package iteration

import "testing"
import "fmt"

func TestRepeat(t *testing.T) {
    repeated := Repeat("a", 5)
    expected := "aaaaa"

    if repeated != expected {
        t.Errorf("expected %q but got %q", expected, repeated)
    }
}

func TestRepeat10(t *testing.T) {
    repeated := Repeat("x", 10)
    expected := "xxxxxxxxxx"

    if repeated != expected {
        t.Errorf("expected %q but got %q", expected, repeated)
    }
}

func BenchmarkRepeat(b *testing.B) {
    for i := 0; i < b.N; i++ {
        Repeat("a", 5)
    }
}

func ExampleRepeat() {
    text := Repeat("x", 10)
    fmt.Println(text)
    // Output: xxxxxxxxxx
}
