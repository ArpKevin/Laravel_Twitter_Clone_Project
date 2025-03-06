using System.Collections;
using TMPro;
using UnityEngine;
using UnityEngine.SceneManagement;

public class RegisterManager : MonoBehaviour
{
    [Header("Register")]
    [SerializeField] TMP_InputField Reg_Email;
    [SerializeField] TMP_InputField Reg_Username;
    [SerializeField] TMP_InputField Reg_Password;
    [SerializeField] TMP_InputField Reg_Password_Repeat;
    [SerializeField] TextMeshProUGUI ErrorText;

    private void Start()
    {
        if (ErrorText != null)
        {
            ErrorText.text = "";
        }
    }

    public void OnRegisterPressed()
    {
        if (ErrorText != null)
        {
            ErrorText.text = "";
        }

        if (Reg_Password.text != Reg_Password_Repeat.text)
        {
            ShowError("Passwords do not match!");
            return;
        }

        StartCoroutine(RegisterUserCoroutine(Reg_Email.text, Reg_Username.text, Reg_Password.text));
    }

    private IEnumerator RegisterUserCoroutine(string email, string username, string password)
    {
        yield return StartCoroutine(DB_Manager.RegisterUser(email, username, password, (success, message) =>
        {
            if (success)
            {
                Debug.Log("Successfully registered!");
                SceneManager.LoadScene(1); // Make sure this scene index is correct for your login scene
            }
            else
            {
                ShowError(message);
            }
        }));
    }

    private void ShowError(string message)
    {
        if (ErrorText != null)
        {
            ErrorText.text = message;
        }
        Debug.LogError(message);
    }
}
